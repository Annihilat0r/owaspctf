<?php
$unreadable='(.#)|(VY[\ULFMH]VYZF[OLFIYH]L}';
$readable=strtr($unreadable,'"#$%&\'()*+,-./0123456789:;<=>abcdefghijklmnopqrstuvwxyz?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`{|}',
                            '@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]!"#$%&\'()*+,-./0123456789:;<=>?^_`abcdefghijklmnopqrstuvwxyz{}~'
                      );
print $readable;

?>
