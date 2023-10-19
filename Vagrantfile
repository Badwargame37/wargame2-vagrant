Vagrant.configure("2") do |config|
    # Set the box to Ubuntu 20.04
  config.vm.box = "debian/bullseye64"

  # Set the IP address of the server
  config.vm.network "private_network", ip: "192.168.190.15"
  config.vm.synced_folder "./Wargame", "/opt/wargame"
 
  config.vm.provider "virtualbox" do |vb|
    vb.memory = "4096"
    vb.cpus = "6"
  end

 
  # Script to provision the virtual machine
  config.vm.provision "shell", inline: <<-SHELL
    # Update the package repository and install dependencies
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
	sudo useradd -m -s /bin/bash Merl1n_Th3_W1z4rd
	echo "Merl1n_Th3_W1z4rd:Excal1bur&St4rDust" | sudo chpasswd

    #python3 install.py
    #cat /home/vagrant/battlestar_email.txt
    #cp /home/vagrant/battlestar_email.txt /opt/wargame2-vagrant/Wargame/level8/xxe/Secret-Confidentiel-file.txt
    cd /opt/wargame2-vagrant/Wargame/
    docker-compose build
    docker-compose up -d
	pids=$(sudo lsof -t -i :80)
	# Check if there are any PIDs
	if [ -n "$pids" ]; then
		# Kill the processes using port 80
		sudo kill -9 $pids
		echo "Killed processes with port 80."
	else
		echo "No processes found using port 80."
	fi
	echo 'ESD{M3RLIN_L0V3S_STARBUCK}' > /root/flag.txt
	echo "root:M3RLIN_L0V3S_STARBUCK " | sudo chpasswd
  	echo 'Address : \4{eth1} # Changer avec le nom de l’interface réseau'>> /etc/issue
	'root : M3RLIN_L0V3S_STARBUCK '>> /etc/issue
	chmod 700 /etc/issue
	chmod 700 /opt/ -R
	docker-compose up -d
	############################reboot chec service #########
	chmod +x /opt/wargame2-vagrant/Wargame/script.sh
	cp /opt/wargame2-vagrant/Wargame/wargame.service /etc/systemd/system/wargame.service
	sed -i 's/\r$//' /opt/wargame2-vagrant/Wargame/script.sh
	bash /opt/wargame2-vagrant/Wargame/script.sh
	
	sudo systemctl daemon-reload
	
	sudo systemctl enable wargame.service
	sudo systemctl start wargame.service

    echo "All installations completed."
  SHELL
end
