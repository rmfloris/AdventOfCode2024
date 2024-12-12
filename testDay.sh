#!/bin/bash

# Function to validate day input
validate_day() {
    local day=$1
    
    # Check if input is a number
    if ! [[ "$day" =~ ^[0-9]+$ ]]; then
        echo "Error: Input must be a number."
        return 1
    fi
    
    # Check if number is between 1 and 25
    if (( day < 1 || day > 25 )); then
        echo "Error: Day must be between 1 and 25."
        return 1
    fi
    
    return 0
}

replace_placeholders() {
    local day=$1
    local input_file=$2
    local output_file=$3
    
    # Use sed to replace {:day} placeholder
    sed "s/{:day}/${day}/g" "$input_file" > "$output_file"
}

# Check if a day number is provided
if [ $# -eq 0 ]; then
    echo "Error: Please provide a day number as an argument."
    echo "Usage: $0 <day_number>"
    echo "Day number must be between 1 and 25."
    exit 1
fi

# Validate the input day
if ! validate_day "$1"; then
    exit 1
fi

# Store the day number from the first argument
DAY=$1

# Source directory for files to be copied
testFiles="./tests/Day$DAY/day${DAY}Test.php"

echo "Running PHPUnit tests for $1:"
phpunit $testFiles


