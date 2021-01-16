<?php

class Db 
{
    protected static $koneksi;

    public function konek() 
	{
        if(!isset(self::$koneksi))
		{
            self::$koneksi = new mysqli('localhost', 'root', '', 'tb_game');
        }
        if(self::$koneksi === false)
		{
            return FALSE;
        }
        return self::$koneksi;
    }

    public function query($query)
	{
        $koneksi = $this->konek();
        $hasil = $koneksi->query($query);
		if($hasil == TRUE)
		{
			return TRUE;
		}
		else
		{
			return '0';
		}
	}

    public function select($query)
	{
        $rows = array();
		$koneksi = $this->konek();
        $hasil = $koneksi->query($query);
        if($hasil === false)
		{
            return FALSE;
        }
        while ($row = $hasil->fetch_assoc())
		{
            $rows[] = $row;
        }
		
        return $rows;
    }
	
	public function hapus($tabel, $kolom, $nilai)
	{
		
		if($this->tersedia($tabel, $kolom, $nilai) == 1)
		{
			$hasil = $this->query("DELETE FROM $tabel WHERE $kolom =".$nilai);
			return TRUE;
		}
		else
		{
			return '0';
		}
	}

	public function	tersedia($tabel, $kolom, $nilai) 
	{
		$koneksi = $this->konek();
        $hasil = $koneksi->query("SELECT * FROM $tabel WHERE $kolom = '".$nilai."'");
		if($hasil == TRUE)
		{
			if($hasil->num_rows == 1) 
			{
				return TRUE;
			}
			else
			{
				return '0';
			}
		}
	}

    public function error()
	{
        $koneksi = $this->konek();
        return $koneksi->error;
    }

    public function antisqlinjection($nilai)
	{
        $koneksi = $this->konek();
        return "" . $koneksi->real_escape_string($nilai) . "";
    }

    public function keluar()
    {
        mysqli_close(self::$koneksi);
    }

}
?>