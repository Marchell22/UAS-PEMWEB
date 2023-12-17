<?php

class DataHandler
{
    private $conn;

    public function __construct($conn) {
        if (!$conn) {
            throw new Exception("Koneksi database tidak valid.");
        }
        $this->conn = $conn;
    }

    public function addData($name, $email, $nim, $gender, $date, $address)
    {
        $browser = $this->getBrowser();
        $ip_address = $this->getIPAddress();

        $query = "INSERT INTO data (name, email, nim, gender, date, address, browser, ip_address, timestamp) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssssss", $name, $email, $nim, $gender, $date, $address, $browser, $ip_address);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

        $stmt->close();
    }

    private function getBrowser()
    {
         $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $browser = "Unknown Browser";

    if (strpos($user_agent, 'MSIE') !== FALSE)
        $browser = 'Internet Explorer';
    elseif (strpos($user_agent, 'Trident') !== FALSE)
        $browser = 'Internet Explorer';
    elseif (strpos($user_agent, 'Edge') !== FALSE)
        $browser = 'Microsoft Edge';
    elseif (strpos($user_agent, 'Firefox') !== FALSE)
        $browser = 'Mozilla Firefox';
    elseif (strpos($user_agent, 'Chrome') !== FALSE)
        $browser = 'Google Chrome';
    elseif (strpos($user_agent, 'Safari') !== FALSE)
        $browser = 'Safari';
    elseif (strpos($user_agent, 'Opera') !== FALSE)
        $browser = 'Opera';

    return $browser;
    }

    private function getIPAddress()
    {
        $ip_address = $_SERVER['REMOTE_ADDR'];

        if ($ip_address == "::1" || $ip_address == "127.0.0.1") {
            $ip_address = gethostbyname($_SERVER['SERVER_NAME']);
        }

        return $ip_address;
    }
}

?>
