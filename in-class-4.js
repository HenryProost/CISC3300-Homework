console.log("in-class-4 is loaded!")

const nums = [1, 2, 3, 4, 5];
for(let i = 0; i < nums.length; i++)
{
    if (nums[i] % 2 != 0)
    {
        console.log(`${nums[i]} is odd!`)
    } 
    else
    {
        console.log(`${nums[i]} is even!`)
    }
}