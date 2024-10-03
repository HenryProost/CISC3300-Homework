const cats = [
    {
        name: 'Charlie',
        adoptionStatus: 'available'
    },
    {
        name: 'Lily',
        adoptionStatus: 'not-available'
    },
    {
        name: 'Coco',
        adoptionStatus: 'available'
    },
    {
        name: 'Oreo',
        adoptionStatus: 'not-available'
    },
    {
        name: 'Luna',
        adoptionStatus: 'available'
    },
    {
        name: 'Milo',
        adoptionStatus: 'available'
    },
    {
        name: 'Lola',
        adoptionStatus: 'not-available'
    },
    {
        name: 'Leo',
        adoptionStatus: 'available'
    },
    {
        name: 'Willow',
        adoptionStatus: 'available'
    },
    {
        name: 'Bella',
        adoptionStatus: 'not-available'
    },
    {
        name: 'Max',
        adoptionStatus: 'available'
    },
    {
        name: 'Cleo',
        adoptionStatus: 'available'
    },
    {
        name: 'Lucy',
        adoptionStatus: 'not-available'
    },
    {
        name: 'Daisy',
        adoptionStatus: 'available'
    },
]

// Question 6
const results = []; //empty list for avaliable cats
let text;

for (let i = 0; i < cats.length; i++)
{
    if (cats[i].adoptionStatus == 'available')
    {
        results.push(cats[i].name)
        text = results.join(" and ")
    }
}
console.log(text, 'are my new cats!')

// Question 7
let ranVar = Math.random() * 10;
const ternaryValue = ranVar > 5 ? 'is greater than five!' : 'is less than five!';
console.log(ranVar, ternaryValue);

// Question 8
for (const cat of cats)
{
    console.log(`Name: ${cat.name}, Adoption Status: ${cat.adoptionStatus}`);
}

//Question 9
//If Statement for same value. Returns True
if (1 == '1'){}
//If Statement for same value and type. Returns False
if (1 === '1'){}

const cats2 = cats.map(function(cat){
     return cat.name + " is cute!";
});

console.log(cats2);