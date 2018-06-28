au_ban
## Running this project
    1. run `php artisan serve` at the root
    2. run `npm run dev` at Xfontend/au_bon
    3. configure the database in .env of root
    4. run sql server from xampp/wampp
    5. run `php artisan migrate`
    6. create a  admin entry from localhost:8080/create-admin
    7. Use your id to login into dashboard from homepage
    
## Things to Do:
    [*]Add restro
    [*]add branch
    [*]add Category
    [*]add items
    [ ]add tables
    [*]add staffs
    [*]add managers
    [ ]transaction window
    [ ]print billing
    [ ]steward table
    [ ]customer table
    
#issues
    [ ] on create branch if restro id is wrong
        send error response
/*
 * Routes for billing
 * 1.add to bill an item
 * 2.finish transaction
 * check if customer exist in DB based on mobile number
 * fetch his data if he does
 * add him if he doesn't
 * create select based on get category
 * fetch items based on branch display according to category
 *  * with item details
 * with add item send it to bill transaction and with the transaction id create tran_detail
 *
 *
 */