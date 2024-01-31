# SavannaTrace-Assesment
Hello and welcome to my technical assessment that involved using a Laravel MQTT backend to retrieve the IP address of a machine and display it back to the user using a Vuejs fronted.

-> From what I understood MQTT is a standard messaging protocol for the Internet of Things (IoT) kind of like http.
-> It is designed as an extremely lightweight publish/subscribe messaging transport that is ideal for connecting remote devices with a small code footprint and minimal network bandwidth.(MQTT website https://mqtt.org/)

->The backend (laravel(php)) retrieves the device's IP address, publishes the address to an MQTT broker, making it accessible to other MQTT clients.

-> The frontend (Vue.js) creates a simple web interface to display the device's IP address. It fetches the address from the route and then displays it.

-> I used the MQTT library from the https://github.com/php-mqtt repository which shows how to install and configure the MQTT laravel client. 

-> I used the Laravel documentation to refresh my brain on how to install and setup laravel.

-> I used the youtube video https://www.youtube.com/watch?v=Su8dWVrHdkc&t=11s&ab_channel=CodeWithTony to learn how to install and incorporate Vuejs3 in laravel 10.

->Chat-GPT and BARD were used to help with understanding and solving the error messages.
