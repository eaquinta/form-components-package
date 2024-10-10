# Debe ejecutar este comando por los permisos de ejecucion
# PS> Set-ExecutionPolicy Unrestricted -Scope CurrentUser
# Se ejecuta así
# PS> .\commit.ps1
# Function to get current date and time in the specified format
function Get-DateTime {
    return (Get-Date -Format "yyyy-MM-dd HH:mm")
}

# Get the current date and time
$dateTime = Get-DateTime

# Add the new file to git
git add -A

# Commit the new file with a message
git commit -m "$dateTime"

git push
# Output the file name
Write-Output "Migration '$dateTime' created, committed and pushed."