<?php

/*

Opini kami hal yang paling utama  dari segi coding yaitu Menerapkan  hasil dari materi perkulihan praktikum pbo yaitu menggunakan class, dan CRUD (CREATE, READ, UPDATE, DELETE)


Faizal Rifaldy
Rifki Renaldi

*/



session_start();
require 'class_koneksi.php';
date_default_timezone_set("Asia/Jakarta");

class Pengguna
{

    public function __construct() //Paling pertama di proses dalam script class
    {
        $this->db = new Db();
	}


	public function IsLogged() // mendeteksei sudah status login
	{
		if(isset($_SESSION['logged']))
		{
			if($_SESSION['logged'] == true)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
		return false;
	}


	public function Login($username, $password) // fungsi login
	{
		$username = $this->db->antisqlinjection($username);
		$password = $this->db->antisqlinjection($password);

		if($this->db->tersedia("pengguna", "username", $username) || $this->db->tersedia("pengguna", "email", $username))
		{
			$hasil = $this->db->select("SELECT * FROM `pengguna` WHERE `username` = '$username' OR `email` = '$username'");
			if($hasil[0]['password'] == $password)
			{
				$this->db->query("UPDATE `pengguna` SET `ip_terakhir_login` = '".$this->DatapatkanIP()."', `terakhir_login` = '".date("Y-m-d H:i:s")."' WHERE `username` = '".$username."';");
				$this->db->query("INSERT INTO `log_login` (`id`, `id_pengguna`, `ip`, `waktu`, `perangkat_lunak`, `perangkat_keras`) VALUES (NULL, '".$hasil[0]['id']."', '".$this->DatapatkanIP()."', '".date("Y-m-d H:i:s")."', '".$this->DapatkanPerangkatUser()."', '".$this->DapatuserOS()."');");
				$_SESSION['logged'] = true;
				$_SESSION['username'] = $username;
				echo "<meta http-equiv='refresh' content='0; url=".$this->Urlwebnya()."index.php'>";
			}
			else
			{
				echo "<script>alert('username, email atau Password Salah!!!.');</script><script>window.history.back()</script>"; 
			}
		}
		else
		{
			echo "<script>alert(' username, email atau Password Salah!!!.');</script><script>window.history.back()</script>"; 
			return true;
		}
		return false;
	}

	public function Hapusvoc($id)
	{
		$result = $this->db->hapus("sql_voucher", "vid", $id);
		return $result;
	}

	public function Gantipass($oldpassword, $npassword, $renpassword) // fungsi daftar akun
	{
		$oldpassword    = $this->db->antisqlinjection($oldpassword);
		$npassword      = $this->db->antisqlinjection($npassword);
		$renpassword    = $this->db->antisqlinjection($renpassword);

		$username = $_SESSION['username'];

		$hasil = $this->db->select("SELECT * FROM `pengguna` WHERE `username` = '$username' OR `email` = '$username'");
		
		if($hasil[0]['password'] != $oldpassword)
		{
			@$kesalahan = true;
			echo "<script>alert('Password yang anda masukan salah!');</script><script>window.history.back()</script>"; 
		}
	
		if($npassword != $renpassword)
		{
			@$kesalahan = true;
			echo "<script>alert('new Password dan new  Re-type Password tidak sama!');</script><script>window.history.back()</script>"; 
		}

		if(strlen($renpassword) < 8)
		{
			@$kesalahan = true;
			echo "<script>alert('Password harus minimal 8 karakter');</script><script>window.history.back()</script>"; 
		}

		if(!@$kesalahan)
		{
			$result = $this->db->query("UPDATE `pengguna` SET `password` = '".$renpassword."' WHERE `username` = '".$username."'");

			if($result)
			{
				echo "<script>alert('Ganti password berhasil!');</script><script>window.location.href = '/home.php';</script>";
			}
			else
			{
				echo "<script>alert('Terjadi kesalahan saat megganti!');</script><script>window.history.back()</script>";
			}
		}


	}

	public function Daftar($username, $email, $password, $repassword, $kelamin) // fungsi daftar akun
	{
		$username    = $this->db->antisqlinjection($username);
		$email       = $this->db->antisqlinjection($email);
		$password    = $this->db->antisqlinjection($password);
		$repassword  = $this->db->antisqlinjection($repassword);
		$kelamin 	 = $this->db->antisqlinjection($kelamin);

		if(!$this->db->tersedia("pengguna", "username", $username))
		{
			if(!$this->db->tersedia("pengguna", "email", $email))
			{
				
				if(strlen($password) < 8)
				{
					@$kesalahan = true;
					echo "<script>alert('Password harus minimal 8 karakter');</script><script>window.history.back()</script>"; 
				}
			
				if($password != $repassword)
				{
					@$kesalahan = true;
					echo "<script>alert('Password dan Re-type Password tidak sama!');</script><script>window.history.back()</script>"; 
				}	
				if(!@$kesalahan)
				{
					$result = $this->db->query("INSERT INTO `pengguna` (`id`, `username`, `password`, `kelamin`, `email`, `tanggal_daftar`, `terakhir_login`, `ip_terakhir_login`) VALUES (NULL, '".$username."', '".$password."', '".$kelamin."', '".$email."', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."', '".$this->DatapatkanIP()."');");

					if($result)
					{
						echo "<script>alert('Akun kamu berhasil di buat silahkan login!');</script><script>window.location.href = '/index.php';</script>";
					}
					else
					{
						echo "<script>alert('Terjadi kesalahan saat membuat akun!');</script><script>window.history.back()</script>";
					}
				}
			}
			else
			{
				echo "<script>alert('Alamat E-mail yang kamu input sudah di gunakan oleh orang lain!');</script><script>window.history.back()</script>";
			}
		}
		else
		{
			echo "<script>alert('Nama karakter ini sudah di gunakan oleh orang lain!');</script><script>window.history.back()</script>"; 
		}
	}


	public function BuatVoucher($key, $balance) // fungsi buat voucher
	{
		$key    	= $this->db->antisqlinjection($key);
		$balance	= $this->db->antisqlinjection($balance);

		if(!$this->db->tersedia("sql_voucher", "key", $key))
		{	
			$result = $this->db->query("INSERT INTO `sql_voucher` (`vid`, `key`, `balance`, `dibuatoleh`) VALUES (NULL, '".$key."', '".$balance."', '".$_SESSION['username']."');");

			if($result)
			{
				echo "<script>alert('Voucher berhasil di buat');</script><script>window.history.back()</script>"; 
			}
			else
			{
				echo "<script>alert('Terjadi kesalah!');</script><script>window.history.back()</script>";
			}	
		}
		else
		{
			echo "<script>alert('Key Voucher tersebut sudah di gunakan coba buat lagi!');</script><script>window.history.back()</script>"; 
		}
	}




	public function Reedemvoucher($key) // fungsi reedemcode
	{
		$key = $this->db->antisqlinjection($key);

		if($this->db->tersedia("sql_voucher", "key", $key))
		{
			$ambil = $this->db->select("SELECT * FROM `sql_voucher` WHERE `key` = '$key'");
			$balance = $ambil[0]['balance'];
			$status = $ambil[0]['status'];

			if($status >= 1)
			{
				echo "<script>alert('Kode yang kamu input sudah di reedem oleh orang lain!');</script><script>window.history.back()</script>";
			}
			else
			{
				$this->db->query("UPDATE `pengguna` SET `diamond` = diamond + '$balance' WHERE `username` = '".$_SESSION['username']."';");
				$this->db->query("UPDATE `sql_voucher` SET `status` = '1', `reedemby` = '".$_SESSION['username']."' WHERE `key` = '$key';");

				echo "<script>alert('Kode berhasil di REEDEM!');</script><script>window.history.back()</script>"; 
			}
		}
		else
		{
			echo "<script>alert('Key yang kamu masukan tidak dikenal!');</script><script>window.history.back()</script>"; 
			return true;
		}
		return false;
	}


	public function DatapatkanIP() // fungsi pendapat ip 
	{
		$ip = $_SERVER['REMOTE_ADDR'];	
		return $ip;
	}

	public function Getnamefromid($id)
	{
		$result = $this->db->select("SELECT username as nama FROM pengguna JOIN log_login WHERE '$id' = pengguna.id;");
		return $result[0]['nama'];
	}

	public function Urlwebnya() // filter url berdasarkan  folder 
	{
		$fullurl = "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
		return $fullurl;
	}


	public function TotalPendaftar()
	{
		$result = $this->db->select("SELECT COUNT(*) AS total FROM pengguna;");
		return $result[0]['total'];
	}

	public function IsAdmin($username)
	{
		$username = $this->db->antisqlinjection($username);
		$result   = $this->db->select("SELECT * FROM `pengguna` WHERE `username` = '$username'");
		if($result[0]['admin'] >= 1)
		{
			return true;
		}
		else
		{
			return false;
		}
		return false;		
	}

	public function Pilihsemuauser()
	{
		$result = $this->db->select("SELECT * FROM pengguna");
		return $result;
	}

	public function Pilihsemuavoucher()
	{
		$result = $this->db->select("SELECT * FROM sql_voucher");
		return $result;
	}


	public function Pilihloglogin()
	{
		$result = $this->db->select("SELECT * FROM log_login");
		return $result;
	}


	public function dolarformat($username, $field)
	{
		$result = $this->db->select("SELECT * FROM `pengguna` WHERE `username` = '$username'");
		
		$filed = $result[0][$field];

		$result = number_format($filed, 0);
		return $result;
	}

	public function Getstats($username, $field)
	{
		$result = $this->db->select("SELECT * FROM `pengguna` WHERE `username` = '$username'");
		
		$result = $result[0][$field];
		return $result;
	}


	public function dolarformatall($field)
	{
		$result = "$".number_format($field, 0);
		return $result;
	}

	public function FormatNumber($field)
	{
		$result = number_format($field, 0);
		return $result;
	}

	public function Kelamin($username)
	{
		$result = $this->db->select("SELECT * FROM `pengguna` WHERE `username` = '$username'");

		if($result[0]['kelamin'] == 1)
		{
			$kelamin = 'Laki - Laki';
		}
		if($result[0]['kelamin'] == 2)
		{
			$kelamin = 'Perempuan';
		}
		return $kelamin;
	}

	public function kelaminall($field)
	{
		if($field == 1)
		{
			$kelamin = 'Laki - Laki';
		}
		if($field == 2)
		{
			$kelamin = 'Perempuan';
		}
		return $kelamin;
	}

	public function statusall($field)
	{
		if($field >= 1)
		{
			$result = 'Admin';
		}
		else
		{
			$result = 'User';
		}
		return $result;
	}


	public function statusvoucher($field)
	{
		if($field >= 1)
		{
			$result = 'Terpakai';
		}
		else
		{
			$result = 'Belum Terpakai';
		}
		return $result;
	}

	public function DapatkanPerangkatUser() // daopat perangkat webbrowser
	{
		return $_SERVER["HTTP_USER_AGENT"];
	}


	public function url($url, $timeout)
	{
		//mengambil data menggunakan curl
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	} 

	public function DapatuserOS() // menggunakan api useragentstring.com untung mendapat osnya.
	{
		$useragent = $_SERVER["HTTP_USER_AGENT"];
		$user_load = $this->url("http://www.useragentstring.com/?uas=".urlencode($useragent)."&getJSON=all", 5);
		$user_load = json_decode($user_load);
		$os = $user_load->os_type." (".$user_load->os_name.")";
		return $os;
	}


}

?>