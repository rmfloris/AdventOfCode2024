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
YEAR=2023

# Source directory for files to be copied
BASE_SOURCE_DIR="./BaseFiles"

# Copy and rename 4 files
# Note: Modify the file extensions and sources as needed
FILES_TO_COPY=(
    "Day.php.skeleton:src/day$DAY:day$DAY.php"
    "dayTest.php.skeleton:tests/Day$DAY:day${DAY}Test.php"
    "input.sample.txt:src/input/sample:day$DAY.txt"
)

# Loop through files and copy with day-specific naming
for file_info in "${FILES_TO_COPY[@]}"; do
    # Split the file info
    IFS=':' read -r source_file dest_subdir output_filename <<< "$file_info"
    
    # Full paths
    source_path="$BASE_SOURCE_DIR/$source_file"
    dest_subdir_path="$dest_subdir"
    dest_file_path="$dest_subdir_path/$output_filename"
    
    # Create destination subdirectory if it doesn't exist
    mkdir -p "$dest_subdir_path"
    
    # Check if source file exists
    if [ ! -f "$source_path" ]; then
        echo "Warning: Source file $source_path does not exist. Skipping."
        continue
    fi
    
    # Replace placeholders and copy
    replace_placeholders "$DAY" "$source_path" "$dest_file_path"
    
    # Check if copy was successful
    if [ $? -eq 0 ]; then
        echo "Successfully processed $source_file to $dest_file_path"
    else
        echo "Failed to process $source_file"
    fi
done

# # Remote file retrieval using wget
# # Replace with actual remote server details
REMOTE_URL="https://adventofcode.com/${YEAR}/day/${DAY}/input"
LOCAL_SAVE_PATH="src/input/day${DAY}.txt"

# Curl command with cookie and user agent
curl -L \
     -b "session=53616c7465645f5fa62d77ed438debd6ca487a5edae05c33978d6c2251c1ea25de99ee93f190556dda459034983ac9d117861c61326bf08fd7afe80a772ebf42" \
     -A "github.com/rmfloris" \
     -o "$LOCAL_SAVE_PATH" \
     "$REMOTE_URL"

# Check if file retrieval was successful
if [ $? -eq 0 ]; then
    echo "Successfully retrieved remote file to $LOCAL_SAVE_PATH"
else
    echo "Failed to retrieve remote file"
    exit 1
fi

echo "Script completed successfully."