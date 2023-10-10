import os

# Define the username and password
USERNAME = "Merl1n_Th3_W1z4rd"
PASSWORD = "Excal1bur&St4rDust"
PRIVATE_KEY_FILE = "/home/vagrant/merlin.txt"
EMAIL_FILE = "/home/vagrant/battlestar_email.txt"

# Create the user with the restricted shell
os.system(f"useradd -m -s /usr/local/bin/rbash_custom {USERNAME}")

# Set the user's password
os.system(f"echo {USERNAME}:{PASSWORD} | chpasswd")

# Allow SSH access for the user
with open("/etc/ssh/sshd_config", "a") as ssh_config:
    ssh_config.write(f"AllowUsers {USERNAME}\n")

# Set the restricted shell for the user
os.system(f"sudo chsh -s /usr/local/bin/rbash_custom {USERNAME}")

# Create the custom rbash script
rbash_script = """
#!/bin/bash
# rbash_custom - Restricted shell for SSH

# Define allowed commands
ALLOWED_COMMANDS="cat whoami id tar wget echo"

# Get the requested command
REQUESTED_COMMAND="$SSH_ORIGINAL_COMMAND"

# Check if the requested command is in the allowed list
if [[ $ALLOWED_COMMANDS =~ $REQUESTED_COMMAND ]]; then
    # Execute the requested command
    exec "$REQUESTED_COMMAND"
else
    echo "Permission denied for $REQUESTED_COMMAND"
    exit 1
fi
"""

with open("/usr/local/bin/rbash_custom", "w") as rbash_custom:
    rbash_custom.write(rbash_script)

# Make the rbash_custom script executable
os.system("chmod +x /usr/local/bin/rbash_custom")

# Generate an RSA key pair for the user without prompts
os.system(f"sudo -u {USERNAME} ssh-keygen -t rsa -N '' -f /home/{USERNAME}/.ssh/id_rsa")

# Copy the private key to the specified file
os.system(f"sudo -u {USERNAME} cp /home/{USERNAME}/.ssh/id_rsa {PRIVATE_KEY_FILE}")

# Prepare the email message
email_message = f"""To: Merlin of Camelot
Subject: Battlestar Galactica Credentials - Magic Meets the Stars

Greetings Merlin, Wizard of the Round Table,

We hope this raven-delivered message finds you well amidst the enchanting realms of Camelot! In a most unexpected twist of fate, the good folks over at Battlestar Galactica have deemed you worthy of access to their futuristic, interstellar systems.

With these credentials, you shall now wield the power of technology alongside your magical prowess:
Protocol: SSH
Username: Merl1n_Th3_W1z4rd
Password: Excal1bur&St4rDust
RSA Key:
"""

# Read the RSA key and append it to the email message
with open(f"/home/{USERNAME}/.ssh/id_rsa", "r") as rsa_key_file:
    rsa_key = rsa_key_file.read()
    email_message += rsa_key

email_message += """
As you embark on this cosmic journey, please remember the following:

1. Magic spells may not work as expected in zero-gravity environments.

2. While you may be familiar with dragons, you'll encounter Cylons of a different kind - so keep that wizard staff at the ready!

3. "So say we all" is the Battlestar Galactica equivalent of "Abracadabra."

4. In space, the phrase "Once upon a time" takes on a whole new meaning.

Should you need technical support, simply summon "Tech Supportatron 3000" by chanting "Ctrl + Alt + Merlin." They'll be at your service faster than a fire-breathing dragon!

We trust that you will use your newfound access responsibly and refrain from turning any Vipers into newts.

May your journey through the stars be as magical as it is interstellar!

Yours in mirth and stardust,
Admiral Adama & the Crew of Battlestar Galactica
"""

# Save the email message to a file
with open(EMAIL_FILE, "w") as email_file:
    email_file.write(email_message)

# Restart SSH service to apply changes
os.system("service ssh restart")

print(f"User '{USERNAME}' has been created with rbash and SSH access.")
