# J24-Games

Cake 3.* application that displays info from the IGDB API.

## Installation
> ●	Provide a README file that succinctly explains how to deploy, install, and run the project

Installation is covered in `/ansible/README.md`.

## Deployment
> ●	Provide a README file that succinctly explains how to deploy, install, and run the project

Deployment is coverd in `/ansible/README.md`.

## Testing
> ●	Show how you have given testing due consideration throughout the task

I didn't want to test the IGDB API as it may change. If I really wanted some indication that it was still working I would set up a really simple test that checks that their API is still online and would check this when deploying updates and/or every day.

I also didn't want to test that the Cake framework is saving Games and their Websites correctly.

I would be able to test that the routes are displaying the minimum information required, but I didn't write these tests.

## Optimisation
> ●	Show how you have either benchmarked or optimised your SQL statements

The index page checks the `modified` date of the latest entry into the `top500_updates` table to see if it should refresh the information in the database. To speed this process up I've created an index on the `modified` field so that this information is also available in the index so that MySQL does not have to perform another lookup.

I would have created an index on the information retrieved from the `games` table however that includes a `text` field and so it wouldn't be able to fit all the required information.

As the app is (at the moment) only concerned with the latest 500+ games each game is checked to see if it already exists in the database before adding, using a unique index on the `slug` of the game. If the number of games the app is converned withe
 were to grow then it would make more sense to remove this check from each game and consider pruning the database at a set time each day to remove duplicates.

## Notes
> ○	Highlight in the README file what work you have undertaken

- add Anstead Ansible project
- change Laravel settings to Cake
- signed up to IGDB
- loaded up Postman and played with their API for a bit
- stole the Bootstrap docs design

- wrote the migrations
- cake bake

- install `friendsofcake/crud`
- install `friendsofcake/crud-json-api`

- added JS to display results

### Game

#### hasMany 
- websites ✅ 
- developers  
- publishers 
- genres 
- tags

##### media
- screenshots
- cover
- videos
- artworks

### Re-focus

download the information from their API ✅

when loading the index, retrieve from local if updated today ✅

write a SQL statement to loop through games, modify a field and store it in a new table ✅ 

display that information on the index page ✅

no need for any other pages!

### Issues

had problem with timezone

needs to be UTF8MB because of a Japanese encoding error