#include <iostream>
#include <sstream>
#include <string>
#include <vector>
#include <cstdlib>
#include <unistd.h>

void executeCommand(const std::string& command, const std::string& args) {
    std::string full_command = command + " " + args;
    system(full_command.c_str());
}

int main() {
    std::string input;

    while (true) {
        std::cout << "rbash> ";
        std::getline(std::cin, input);

        std::istringstream iss(input);
        std::string command;
        iss >> command;

        std::string remaining_args;
        std::getline(iss, remaining_args);

        if (command == "ls" || command == "echo" || command == "pwd" || command == "tar" || command == "grep" || command == "cat") {
            executeCommand(command, remaining_args);
        } else if (command == "exit") {
            std::cout << "Exiting rbash." << std::endl;
            break;
        } else if (command == "help") {
            std::cout << "Available commands:" << std::endl;
            std::cout << "ls, echo, pwd, tar, grep, cat, exit, help" << std::endl;
        } else {
            std::cout << "Unknown command: " << command << std::endl;
        }
    }

    return 0;
}
