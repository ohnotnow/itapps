#!/usr/bin/perl

use Digest::MD5 qw(md5 md5_hex md5_base64);
use LWP::Simple;
use File::Copy;

my $api_base = 'http://itapps.dev/api/v1';
my $temp_dhcp = '/tmp/dhcpd.temp';
my $real_dhcp = '/tmp/dhcpd.conf';
my $dhcpd = '/usr/sbin/dhcpd';

my $new_data = get($api_base . '/getdhcpfile');
die('Failed to get dhcp data via the api!') unless defined $new_data;

open(my $CURRENT, "<", $real_dhcp) or die("Could not open $real_dhcp! $!\n");
$existing_data = join("", <$CURRENT>);
close($CURRENT);

my $new_md5 = md5_hex($new_data);
my $old_md5 = md5_hex($existing_data);
print "New : $new_md5\n";
print "Old : $old_md5\n";
if ($new_md5 == $old_md5) {
	exit;
}

open(my $OUTPUT,">",$temp_dhcp) or die("Could not write to $temp_dhcp! $!\n");
print $OUTPUT $new_data;
close($OUTPUT);

#my $result = system("$dhcpd -t -q -cf $temp_dhcp");
#if ($result) {				# non-zero exit code, so ALERT! ALERT!
#	print "DHCP - Fubar on rebuild! $exit code.\n";
#   exit(1)
#}

copy($temp_dhcp,$real_dhcp);
$result = `/sbin/service dhcpd restart`;
