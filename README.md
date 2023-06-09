# Workshop: Introduction to PHP Server-Side Programming

## Overview
This workshop aims to introduce students to the basics of PHP server-side programming and how to set up a PHP server. Participants will gain hands-on experience in building dynamic web applications and understand the fundamentals of server-side scripting.

## Prerequisites
Basic knowledge of HTML and CSS
Familiarity with JavaScript is a plus but not required
Workshop Setup
To participate in this workshop, follow the steps below to set up the necessary environment:

## Install a local PHP server

You MUST use Windows for this workshop. This being done, install xampp & if you do not have a terminal, you can either install VsCode or use the only platform repl.it that already have bash enabled there!

# Set up a Discord bot
Create a Discord Application

* Visit the [Discord Developer Portal](https://discord.com/developers/applications) and create a new application.
* Give your application a name and click on "Create" to proceed.
* Create a Bot User.
* In the Discord Developer Portal, navigate to your application and select the "Bot" tab.
* Click on "Add Bot" and confirm your action.
* Under the Bot section, you can customize your bot's name, profile picture, and other settings as desired.
* Retrieve the Bot Token

* In the Bot section of your application, locate the "Token" and click on "Copy" to copy the bot token.
* Keep the token secure and do not share it publicly.
* Invite the Bot to [this server](https://discord.gg/EucWs7s9)


```
import discord
from discord.ext import commands

TOKEN = 'MTA3MDEwMTYzOTcwMjI1MzYzOQ.G8XIJd.zN9NSSoxAqVKA9kX57ME7nqv-yxgweKxRzOEFk'

intents = discord.Intents.default()
intents.message_content = True

client = commands.Bot(command_prefix='.', intents=intents)

#####
#####
## Insert other functions here
#####
#####

client.run(TOKEN)
```

Execute this code by doing

```
python3 host.py
```

Create the following files inside C://xampp/htdocs (nowhere else):
* `dashboard.php`
* `index.php`
* `logout.php`
* `process-oauth.php`
* `init-oauth.php`

* Come back on the discord developer portal and on the oauth section, write this:

![Image](https://cdn.discordapp.com/attachments/917404549055123498/1111628277380022313/image.png)

For `init-oauth.php`, write this code:

```
<?php

$discord_url = "Bot's url";
header("Location: $discord_url");
exit();

?>
```

Instead of `Bot's url`, go to "URL generator", and follow this step:

![Image](https://cdn.discordapp.com/attachments/917404549055123498/1111628561372151920/image.png)

You have to grant the three permissions listed above and add your redirect, hence it is important.

On `index.php`, create add this content:

```
<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../dist/output.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="flex items-center justify-center h-screen bg-discord-gray">
        <a href="init-oauth.php" class="bg-discord-blue px-5 py-3 rounded-md hover:bg-gray-600 transition">
            <span class="text-white font-semibold text-xl"><i class="fa-brands fa-discord mr-2"></i> Login with Discord</span>
        </a>
    </div>

</body>
</html>
```

You can see that it's a HTML code, but it's works in PhP too.

On `dashboard.php`, add this content:

```
<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(!$_SESSION['logged_in']){
  header('Location: error.php');
  exit();
}
extract($_SESSION['userData']);

$avatar_url = "https://cdn.discordapp.com/avatars/$discord_id/$avatar.jpg";

$guilds = $_SESSION['userData']['guilds'];
$guildMarkup='';

foreach ($guilds as $key => $guildData) {
    $guildMarkup.='<li class="py-2 px-4 w-full rounded-t-lg border-b border-gray-200 dark:border-gray-600">'.$guildData['name'].'</li>';
}

?>
<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../dist/output.css" rel="stylesheet">
</head>
<body>
    <div class="flex items-center justify-center h-screen bg-discord-gray flex-col">
      <div class="text-white text-3xl">Welcome to the dashboard, </div>
      <div class="flex items-center mt-4">
        <img class="rounded-full w-12 h-12 mr-3" src="<?php echo $avatar_url?>" />
        <span class="text-3xl text-white font-semibold"><?php echo $name;?></span>
      <!--  <ul class="w-96 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white mt-6">
            <h3 class="text-xl font-bold ml-3 text-gray-300 uppercase py-2">Guilds:</h3>
            <?php echo $guildMarkup;?> -->
        </ul>
      </div>
      <a href="logout.php" class="mt-5 text-gray-300">Logout</a>
    </div>

</body>
</html>
```

That code is just the page that `index.php` will send to you after you confirm your input.

## Check if everything works

Next up, open xampp and enable "Apache". To make sure everything works correctly, go to `localhost/index.php`

# Final task: The Link.

The main task of this workshop is to write the code for `process-oauth.php` given the fact it is the link between your index and your dashboard. Feel free to use all the php & discord related documentation about this.

## Create a webhook Discord first

On the Discord server, try to create your webhook and name it. You should find in the parameter of the server in the **Integrations** section.

## Writing ``process-oauth.php``

Create two functions first with these prototypes:

``function addUserToGuild($discord_ID, $token, $guild_ID)``

and

``function getUsersGuilds($auth_token)``

You must use [cURL transmissions](https://en.wikipedia.org/wiki/CURL) [with PhP](https://www.php.net/manual/fr/ref.curl.php)

Pay attention for the error management part, what happens if we want to enter `dashboard.php` directly from the address bar for example ?

**We will let you write the code on your own but feel free to do a lot of research on that topic first. Don't forget that the aim is to create a form like the one we demonstrated.**

# Bonus

If you finished doing this, then you can also think about doing `error.php` and `logout.php`.

As a final bonus, implement this feature on a simple website with a form system linked to a button.

