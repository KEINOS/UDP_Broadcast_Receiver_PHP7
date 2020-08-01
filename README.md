# Sample Docker Container To Receive The UDP Broadcasting Messages in PHP7

## File Description

- Listener: `receiver.php` (Entrypoint script. Receives and processes the broadcasted message)

## What It Does

In this sample container:

1. Creates the socket of UDP broadcast message port and starts to listen the messages.
2. If we receive the broadcast message then it just echoes the message.

## Requirements

The `sockets` PHP extension module is needed to send and receive the messages. This extension is a proxy that connects a socket to others. In this case the UDP port to a variable.

## Sample

To see in action run `docker-compose up` as below.

```bash
$ docker-compose build
...
$ docker-compose up
Creating receiver-php7 ... done
Creating sender-ash    ... done
Attaching to receiver-php7, sender-ash
receiver-php7    | Msg received: Count:0        Broadcasting meow meow from sender-ash   : receiver-php7
receiver-php7    | Msg received: Count:1        Broadcasting meow meow from sender-ash   : receiver-php7
receiver-php7    | Msg received: Count:2        Broadcasting meow meow from sender-ash   : receiver-php7
receiver-php7    | Msg received: Count:3        Broadcasting meow meow from sender-ash   : receiver-php7
receiver-php7    | Msg received: Count:4        Broadcasting meow meow from sender-ash   : receiver-php7
receiver-php7    | Msg received: Count:5        Broadcasting meow meow from sender-ash   : receiver-php7
^CGracefully stopping... (press Ctrl+C again to force)
Stopping sender-ash    ... done
Stopping receiver-php7 ... done
$
```
