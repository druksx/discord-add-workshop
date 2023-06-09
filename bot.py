import discord
from discord.ext import commands

TOKEN = 'MTExNjcwODY3NjUyNzQ1NjI1Ng.GIRCV0.Y-Z30pl1zWLPMqS1j4OJDy_KeD4YK8430EdEyU'

intents = discord.Intents.default()
intents.message_content = True

client = commands.Bot(command_prefix='.', intents=intents)

#####
#####
## Insert other functions here
#####
#####

client.run(TOKEN)