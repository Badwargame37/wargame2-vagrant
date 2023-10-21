Vagrant.configure("2") do |config|
    # Set the box to Ubuntu 20.04
  config.vm.box = "debian/bullseye64"

  # Set the IP address of the server
  config.vm.network "private_network", ip: "192.168.190.15"
  config.vm.synced_folder "./Wargame", "/opt/wargame"
 
  config.vm.provider "virtualbox" do |vb|
    vb.memory = "4096"
    vb.cpus = "4"
  end

 
  # Script to provision the virtual machine
  config.vm.provision "shell", inline: <<-SHELL

    # Restart the SSH service
    systemctl restart sshd
    sudo apt update
    sudo apt install -y apt-transport-https ca-certificates curl gnupg2 software-properties-common
	sudo apt install python3-pip -y
	pip install Flask
    # Install Ansible
    sudo apt update
    sudo apt install -y software-properties-common
    sudo apt-get install gnupg -y
    # Install Docker
    curl -fsSL https://download.docker.com/linux/debian/gpg | sudo apt-key add -
    sudo add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/debian $(lsb_release -cs) stable"
    sudo apt update
    sudo apt install -y docker-ce

    # Install Docker Compose
    sudo curl -L "https://github.com/docker/compose/releases/latest/download/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
    sudo chmod +x /usr/local/bin/docker-compose





    # Install GCC (GNU Compiler Collection)
    sudo apt install -y gcc

    # Add your user to the Docker group
    sudo usermod -aG docker ${USER}

    # Start Docker service
    sudo systemctl start docker
    sudo systemctl enable docker
    sudo su
    cd /opt
    git clone https://github.com/Badwargame37/wargame2-vagrant.git
    cd wargame2-vagrant/Wargame/SSH-Machine
	sudo cp rbash /usr/local/bin/rbash_custom
	sudo chmod +x /usr/local/bin/rbash_custom
    # Update the package repository and install dependencies
	useradd -m -s /usr/local/bin/rbash_custom Merl1n_Th3_W1z4rd
    echo 'Merl1n_Th3_W1z4rd:Excal1bur&St4rDust' | chpasswd

    # Allow SSH password authentication
    sed -i 's/PasswordAuthentication no/PasswordAuthentication yes/g' /etc/ssh/sshd_config
	systemctl restart sshd
	echo '#!/bin/bash
	cd /tmp
	tar -cf /tmp/backup.tar *
	' > /opt/backup_tmp.sh

	# Make the backup script executable
	chmod +x /opt/backup_tmp.sh
	echo "Merl1n_Th3_W1z4rd ALL=(ALL) NOPASSWD: /opt/backup_tmp.sh" > /etc/sudoers.d/Merl1n_Th3_W1z4rd
	chmod 0440 /etc/sudoers.d/Merl1n_Th3_W1z4rd
	
	# Write the note to a text file
	echo "Welcome Merl1n_Th3_W1z4rd, your wisdom and magical prowess are needed!" > /home/Merl1n_Th3_W1z4rd/NOTE.txt
	echo "We urge you to use your wizardry skills to inspect every corner of this realm, from the deepest caverns of the OS to the heights of user land." >> /home/Merl1n_Th3_W1z4rd/NOTE.txt
	echo "Don't forget, even the humblest of creatures may offer great insights. Wink, wink!" >> /home/Merl1n_Th3_W1z4rd/NOTE.txt

	# Change the owner of the note to Merl1n_Th3_W1z4rd
	chown Merl1n_Th3_W1z4rd:Merl1n_Th3_W1z4rd /home/Merl1n_Th3_W1z4rd/NOTE.txt

    #python3 install.py
    #cat /home/vagrant/battlestar_email.txt
    #cp /home/vagrant/battlestar_email.txt /opt/wargame2-vagrant/Wargame/level8/xxe/Secret-Confidentiel-file.txt
    cd /opt/wargame2-vagrant/Wargame/
    docker-compose build
    docker-compose up -d
	pids=$(sudo lsof -t -i :80)
	 Check if there are any PIDs
	if [ -n "$pids" ]; then
		# Kill the processes using port 80
		sudo kill -9 $pids
		echo "Killed processes with port 80."
	else
		echo "No processes found using port 80."
	fi

  
	docker-compose up -d
	echo 'ESD{M3RLIN_L0V3S_STARBUCK}' > /root/flag.txt
	# Créer le fichier restart_wargame_service.sh dans /usr/local/bin
	echo '#!/bin/bash

	cd /opt/wargame2-vagrant/Wargame/
	docker-compose build
	docker-compose up -d

	pids=$(sudo lsof -t -i :80)

	if [ -n "$pids" ]; then
		sudo kill -9 $pids
		echo "Killed processes with port 80."
	else
		echo "No processes found using port 80."
	fi

	docker-compose up -d' | sudo tee /usr/local/bin/restart_wargame_service.sh > /dev/null

	# Rendre le fichier exécutable
	sudo chmod +x /usr/local/bin/restart_wargame_service.sh

	# Créer le fichier de service systemd dans /etc/systemd/system
	echo '[Unit]
	Description=Wargame2 Service
	After=network.target

	[Service]
	Type=simple
	ExecStart=/usr/local/bin/restart_wargame_service.sh
	User=root
	Restart=always

	[Install]
	WantedBy=multi-user.target' | sudo tee /etc/systemd/system/wargame2.service > /dev/null

	# Recharger les configurations de systemd et activer le service
	sudo systemctl daemon-reload
	sudo systemctl enable wargame2.service
	sudo systemctl start wargame2.service

    echo "All installations completed."
	sudo reboot
  SHELL
end
