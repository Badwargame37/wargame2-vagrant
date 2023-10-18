#!/bin/bash
# This script launches Docker Compose services at machine startup
	pids=$(sudo lsof -t -i :80)
	# Check if there are any PIDs
	if [ -n "$pids" ]; then
		# Kill the processes using port 80
		sudo kill -9 $pids
		echo "Killed processes with port 80."
	else
		echo "No processes found using port 80."
	fi
  cd /opt/wargame2-vagrant/Wargame/
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
 docker-compose up -d

