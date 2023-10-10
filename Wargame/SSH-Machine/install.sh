#!/bin/bash

# Define the username and password
USERNAME="Merl1n_Th3_W1z4rd"
PASSWORD="Excal1bur&St4rDust"
PRIVATE_KEY_FILE="/home/vagrant/merlin.txt"

# Create the user with the restricted shell
useradd -m -s /usr/local/bin/rbash_custom "$USERNAME"

# Set the user's password
echo "$USERNAME:$PASSWORD" | chpasswd

# Allow SSH access for the user
echo "AllowUsers $USERNAME" >> /etc/ssh/sshd_config

# Set the restricted shell for the user
sudo chsh -s /usr/local/bin/rbash_custom "$USERNAME"

# Create the custom rbash script
cat <<EOL > /usr/local/bin/rbash_custom
#!/bin/bash
# rbash_custom - Restricted shell for SSH

# Define allowed commands
ALLOWED_COMMANDS="cat whoami id tar wget echo"

# Get the requested command
REQUESTED_COMMAND="\$SSH_ORIGINAL_COMMAND"

# Check if the requested command is in the allowed list
if [[ \$ALLOWED_COMMANDS =~ \$REQUESTED_COMMAND ]]; then
    # Execute the requested command
    exec "\$REQUESTED_COMMAND"
else
    echo "Permission denied for \$REQUESTED_COMMAND"
    exit 1
fi
EOL

# Make the rbash_custom script executable
chmod +x /usr/local/bin/rbash_custom
# Generate an RSA key pair for the user without prompts
sudo -u $USERNAME ssh-keygen -t rsa -N "" -f /home/$USERNAME/.ssh/id_rsa

# Display the public key
echo "Public key:"
cat /home/$USERNAME/.ssh/id_rsa.pub
#!/bin/bash

# Define the username and private key file path


# Copy the private key to the specified file
sudo -u $USERNAME cp /home/$USERNAME/.ssh/id_rsa $PRIVATE_KEY_FILE

# Prepare the email message
EMAIL_MESSAGE="To: Merlin of Camelot
Subject: Battlestar Galactica Credentials - Magic Meets the Stars

Greetings Merlin, Wizard of the Round Table,

We hope this raven-delivered message finds you well amidst the enchanting realms of Camelot! In a most unexpected twist of fate, the good folks over at Battlestar Galactica have deemed you worthy of access to their futuristic, interstellar systems.

With these credentials, you shall now wield the power of technology alongside your magical prowess:
Protocol: SSH
Username: Merl1n_Th3_W1z4rd
Password: Excal1bur&St4rDust
RSA Key: $(cat $PRIVATE_KEY_FILE)

As you embark on this cosmic journey, please remember the following:

1. Magic spells may not work as expected in zero-gravity environments.

2. While you may be familiar with dragons, you'll encounter Cylons of a different kind - so keep that wizard staff at the ready!

3. \"So say we all\" is the Battlestar Galactica equivalent of \"Abracadabra.\"

4. In space, the phrase \"Once upon a time\" takes on a whole new meaning.

Should you need technical support, simply summon \"Tech Supportatron 3000\" by chanting \"Ctrl + Alt + Merlin.\" They'll be at your service faster than a fire-breathing dragon!

We trust that you will use your newfound access responsibly and refrain from turning any Vipers into newts.

May your journey through the stars be as magical as it is interstellar!

Yours in mirth and stardust,
Admiral Adama & the Crew of Battlestar Galactica"

# Save the email message to a file
echo -e "$EMAIL_MESSAGE" > /home/vagrant/battlestar_email.txt

# Display the email message
cat /home/vagrant/battlestar_email.txt


# Restart SSH service to apply changes
service ssh restart

echo "User '$USERNAME' has been created with rbash and SSH access."
