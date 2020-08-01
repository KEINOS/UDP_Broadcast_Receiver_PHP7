<?php

/**
 * Receives the broadcasted UDP message in the network.
 *
 * This script does the same thing as below in Bash:
 *    socat -u UDP-LISTEN:$PORT_UDP_BROADCAST,fork STDOUT
 */

// Socket options
const SOCKET_DOMAIN   = AF_INET;          // Use IPv4 Internet based protocols
const SOCKET_TYPE     = SOCK_DGRAM;       // Support datagrams
const SOCKET_PROTOCOL = SOL_UDP;          // Set Socket Level as UDP
const SOCKET_LEVEL    = SOL_SOCKET;       // Retrieve options at the socket level
const NAME_OPTION     = MCAST_JOIN_GROUP; // Join multicast group
const VAL_OPTION      = 1;                // Join group 1

$name_host   = getenv('NAME_HOST_SELF');
$port        = intval(getenv('PORT_UDP_BROADCAST'));
$len_msg_max = strlen(str_repeat('あ', 255));

// Create socket
$sock = socket_create(SOCKET_DOMAIN, SOCKET_TYPE, SOCKET_PROTOCOL);
socket_bind($sock, '0.0.0.0', $port);
socket_set_option($sock, SOCKET_LEVEL, NAME_OPTION, VAL_OPTION);

// Listen to the broadcasting
while (true) {
    $buff = '';      // Received broadcasting message
    $flag = 0;       // Nothing to modify
    $from_ip = '';   // IP address of the broadcast sender
    $from_port = 0;  // Port number used to received

    // Receive message and buffer
    $result = socket_recvfrom($sock, $buff, $len_msg_max, $flag, $from_ip, $from_port);
    if (false === $result) {
        continue;
    }
    if (empty(trim($buff))) {
        continue;
    }

    // Discharge the buffered message
    echo "Msg received: " . trim($buff) . "\t : ${name_host}" . PHP_EOL;
}
