<?php
set_time_limit(0);
// Datos de acceso a MySQL
$myhost = DB_HOST;
$myuser = DB_USER;
$mypass = DB_PASS;
$DB = @mysql_connect($myhost, $myuser, $mypass) or die(date("Y-m-d H:i", time()) . " ERROR!! No se pudo conectar a MySQL.\r\n");
$OUTDIR = DB_BACKUPS;
$now = date("YmdHi", time());
$outfile = "MySQL_$now.zip";
$periodo = time() - 172800; // Los archivos anteriores a este periodo (2 dias = 172800 segundos) serán borrados
$zip = new ZipArchive;
if (!$zip->open("$OUTDIR$outfile", ZIPARCHIVE::CREATE)) die("ERROR!!\r\n");
$q = @mysql_query("SHOW DATABASES");
while ($database = mysql_fetch_row($q))
    if ($database[0] == DB_NAME) {
        $filename = "{$database[0]}.sql";
        $tempfile = date("YmdHis", time()) . ".~swap";
        system("mysqldump -h $myhost -u $myuser -p$mypass --opt {$database[0]} > $OUTDIR$tempfile");
        $zip->addFile($OUTDIR.$tempfile, $filename);
        $DUMPFILES[] = $OUTDIR.$tempfile;
    }
mysql_close($DB);
$zip->close();
// Eliminar temporales. Importante hacerlo DESPUÉS de cerrar el ZIP
foreach($DUMPFILES as $file)
    @unlink($file);
// Elminar archivos antiguos
$D = opendir($OUTDIR);
while ($F = readdir($D))
    if ($F != "." && $F != "..")
        if (filectime($OUTDIR.$F) < $periodo)
            if (!unlink($OUTDIR.$F))
                //echo date("Y-m-d H:i", time()) . " No se pudo eliminar el archivo $F.\r\n";
closedir($D);
?>