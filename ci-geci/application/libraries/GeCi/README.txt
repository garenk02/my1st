Dida Nurwanda (dida_n@ymail.com)


Penempatan Library

htdocs
-- codeigniter
---- application
------ libraries
-------- GeCi
---------- GeCi.php


// ------------------------------------------------------------------------


Buka File config.php

htdocs/CodeIgniger/application/config/config.php
	
/*
|--------------------------------------------------------------------------
| Enable/Disable System Hooks
|--------------------------------------------------------------------------
|
| If you would like to use the 'hooks' feature you must enable it by
| setting this variable to TRUE (boolean).  See the user guide for details.
|
*/
$config['enable_hooks'] = FALSE;

Ubah Menjadi
	
/*
|--------------------------------------------------------------------------
| Enable/Disable System Hooks
|--------------------------------------------------------------------------
|
| If you would like to use the 'hooks' feature you must enable it by
| setting this variable to TRUE (boolean).  See the user guide for details.
|
*/
$config['enable_hooks'] = TRUE;


// ------------------------------------------------------------------------


Buka File hooks.php

htdocs/CodeIgniger/application/config/hooks.php

Tambahkan Script Berikut
	
$hook['display_override'][]=array(
    'class'=>'CIHooks',
    'function'=>'execute',
    'filename'=>'CIHooks.php',
    'filepath'=>'libraries/GeCi/components'
);


// -----------------------------------------------------------------------

Buka File autoload.php

htdocs/CodeIgniger/application/config/autoload.php

Tambahkan Script Berikut
	
$autoload['libraries'] = array('GeCi/GeCi');


// ----------------------------------------------------------------------

Performa Melambat !

Jangan khawatir, Performa melambat sebab GeCi defaultnya akan meregistrasikan assets di setiap halaman reload. Berikut penjelasan dan cara mengkonfigurasi Assets Manager agar performa kembali cepat. 

Hal ini dapat diatasi dengan mengubah pengaturannya yang terdapat pada folder GeCi/config/config.php. Perhatikan script dibawah ini.
$GC['asset_load'] = 2;

Ubah anggka 2 tersebuat sesuai dengan kebutuhan.

    0 - Assets tidak akan melakukan register, performa sangat cepat.
    1 - Assets akan mengecek apakah file sudah ada atau belum, jika ada maka akan di register kembali, performa sedikit cepat.
    2 - Assets akan selalu meregistrasikan, performa sedikit melambat.
