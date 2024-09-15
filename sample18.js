// Function to check if the array is consecutive
function isConsecutive(arr) {
    if (arr.length < 2) {
        return true;
    }
    
    for (let i = 1; i < arr.length; i++) {
        if (arr[i] !== arr[i - 1] + 1) {
            return false;
        }
    }
    
    return true;
}

// Test cases
console.log(isConsecutive([1, 2, 3, 4, 5])); // Expected output: true
console.log(isConsecutive([5, 4, 3, 2, 1])); // Expected output: false
console.log(isConsecutive([1, 3, 2, 4, 5])); // Expected output: false
console.log(isConsecutive([10, 11, 12, 13])); // Expected output: true
console.log(isConsecutive([2, 3])); // Expected output: true
console.log(isConsecutive([7])); // Expected output: true
