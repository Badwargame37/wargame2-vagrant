#!/bin/bash

# Define the username and the path to the restricted shell script
USERNAME="Merl1n_Th3_W1z4rd"
RESTRICTED_SHELL="/usr/local/bin/rbash_custom"

# Set the user's shell to the restricted shell script
sudo chsh -s "$RESTRICTED_SHELL" "$USERNAME"

# Configure the SSH ForceCommand option for the specific user
if ! grep -q "Match User $USERNAME" /etc/ssh/sshd_config; then
    echo "Match User $USERNAME" | sudo tee -a /etc/ssh/sshd_config
fi
echo "    ForceCommand $RESTRICTED_SHELL" | sudo tee -a /etc/ssh/sshd_config

# Restart SSH service to apply changes
sudo service ssh restart

echo "User '$USERNAME' has been configured with the restricted shell and SSH access."
