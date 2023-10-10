#!/bin/bash

# Define the hostnames and IP addresses you want to add
# Add your hostnames and corresponding IP addresses here
declare -A host_entries=(
    ["level0.wargame.esd"]="127.0.0.1"
    ["level1.wargame.esd"]="127.0.0.1"
    ["level2.wargame.esd"]="127.0.0.1"
    ["level3.wargame.esd"]="127.0.0.1"
    ["level4.wargame.esd"]="127.0.0.1"
    ["level5.wargame.esd"]="127.0.0.1"
    ["level6.wargame.esd"]="127.0.0.1"
    ["level7.wargame.esd"]="127.0.0.1"
    ["level8.wargame.esd"]="127.0.0.1"
)

# Check if the script is run as root
if [ "$EUID" -ne 0 ]; then
    echo "This script must be run as root or with sudo."
    exit 1
fi

# Add entries to the hosts file
for hostname in "${!host_entries[@]}"; do
    ip_address="${host_entries[$hostname]}"
    echo "$ip_address $hostname" >> /etc/hosts
    echo "Added $hostname to /etc/hosts"
done

# Display the updated hosts file
cat /etc/hosts

echo "Hostnames have been added to the hosts file."
