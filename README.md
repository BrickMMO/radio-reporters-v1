BRICKMMO Radio Reporter cms

A CMS for managing the Reporter side of the Brick MMO Radio Application.

Admin can perform crud on all tables. 

Main functionality is for reporters to submit ideas for radio segments. 

They can select what type of segment they would like to submit, for example a sports new report, and then save it
in a bank for producers to review. Upon review within a separt CMS for producers (connected to the same DB)
, a producer can approve a reporter's idea, and send as a prompt for openai to generate a relevent radio segment (which is then converted to audio, and broadcast on the front facing React radio website, alongside music).

Restrictions are in place if logged in with a User role of Reporter. They are implimented using middleware, Kernal, and the Routes.

* If logged in as a User with the role of reporter, all views are restricted to just segment CRUD.

* Any other role will have full CRUD access to all tables.

There is one porthole for login. The Reporter must register prior to log in, and is forced to use an email with a
@humbermail.ca address, at which point they are automatically assigned a 'Reporter' role, thus restricting their access.

If you have an account created from within the system, you can assign whichever role you desire upon creation.

* 'Segment Forms' views and logic are for Reporters, and use dynamic and conditional rendering to create different forms depending on what type of segment is being made (Report/Game/Joke/etc), and then provides dropdown selection for sub_types 
(local news, entertainment, Knock Knock Joke, etc).


