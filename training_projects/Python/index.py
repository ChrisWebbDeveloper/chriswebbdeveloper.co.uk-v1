#! usr/bin/Python


#Setting up html layout
print 'Content-type: text/html'
print ''

print '''

<head>

  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-108066932-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-108066932-1');
</script>

  <!-- START of Training Return Button CSS-->

    <!-- Raleway Font -->
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,500,700,400italic' rel='stylesheet' type='text/css'>
    <!-- jQuery Stylesheet -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" type="text/css" href="../training_button-min.css">

  <!-- END of Training Return Button CSS-->

</head>

<body>

  <!-- START of Training Return Button HTML-->

		<a href="../../index.html#projects" id="training_button" name="training_button">
			<div>
            <p>Click here to return</p>
            <img src="../../images/landing_logo.png" alt="Dean Webb Developer">
			</div>
		</a>

  <!-- END of Training Return Button HTML-->

'''


#Setting form
import cgi
form = cgi.FieldStorage()

mastermindSettings = {
    'typesOfPins'   :   8,
    'noOfPins'      :   4,
    'noOfRows'      :   20,
    'code'          :   None
}

userAnswers = {
    'answerGiven': None,
    'gameOver': False,
    'gameWon': False
}


#Setting all the rows in the userAnswers
def setRows():
    for row in range(1, mastermindSettings['noOfRows'] + 1):
        userAnswers['row' + str(row)] = None

setRows()


#Set saved variables from formCode
saved = {}
def setSavedFromForm():
    for key in mastermindSettings:
        saved[key] = form.getvalue(key)

    for key in userAnswers:
        saved[key] = form.getvalue(key)

setSavedFromForm()


print "<h2>Mastermind</h2>"


#If code is present/saved, set the code as the saved code, else make a new one
def checkCodeExists():

    #Setting code as a string
    def setCode():
        mastermindSettings['code'] = ''
        from random import randint
        for pin in range(1, int(mastermindSettings['noOfPins']) + 1):
            mastermindSettings['code'] += str(randint(1, int(mastermindSettings['typesOfPins'])))

    if saved['code']:
        mastermindSettings['code'] = saved['code']
    else:
        setCode()

checkCodeExists()


#If rows are present/saved, set the code to the saved code
def checkRowsExist():
    for row in range(1, mastermindSettings['noOfRows'] + 1):
        if saved['row' + str(row)]:
            userAnswers['row' + str(row)] = saved['row' + str(row)]

checkRowsExist()


#if answer given prior, set as answer given
def setLastAnswerRowGiven():
    if form.getvalue('pin1'):
        newRow = ''

        for pin in range(1, mastermindSettings['noOfPins'] + 1):
            newRow += str(form.getvalue('pin' + str(pin)))
        userAnswers['answerGiven'] = newRow

        for row in range(1, mastermindSettings['noOfRows'] + 1):
            if userAnswers['row' + str(row)] is None:
                userAnswers['row' + str(row)] = userAnswers['answerGiven']
                break

setLastAnswerRowGiven()


#Create form for user input
print '<form method=\'post\'>'
print '<input type="hidden" name=\'code\' value=' + mastermindSettings['code'] + ' />'

for row in range(1, mastermindSettings['noOfRows'] + 1):
    if userAnswers['row' + str(row)]:
        print '<input type="hidden" name="row' + str(row) + '" value="' + userAnswers['row' + str(row)] + '" />'

for pin in range(1, mastermindSettings['noOfPins'] + 1):
    print '<select name=\'pin' + str(pin) + '\'>'

    for option in range(1, mastermindSettings['typesOfPins'] + 1):
        print '<option value=' + str(option) + '>' + str(option) + '</option>'

    print '</select>'

print '&nbsp;<input type=\'submit\' value=\'Confirm code\' /></form><br />'


#Comparing provided answer to code
def checkAnswer(toCheck):
    fullCorrectPins = 0
    halfCorrectPins = 0

    correctDict = {}

    #Go through each pin in the code
    for pinNo in range(0, len(mastermindSettings['code'])):

        #Find pins that are correct number AND correct position
        if list(toCheck)[pinNo] == mastermindSettings['code'][pinNo]:
            fullCorrectPins += 1
            correctDict[pinNo] = True
        else:
            correctDict[pinNo] = False

    listOfFalse = []

    #Create list of pins to check that are false to see if any correct in other positions
    for pinNo in range(0, len(mastermindSettings['code'])):
        if correctDict[pinNo] is False:
            listOfFalse.append(pinNo)

    #Go through listOfFalse
    for pinNo in listOfFalse:
        posCheck = toCheck[pinNo]
        #Compare to code, if any correct set to True and remove from list so not checked again
        for pinNo in listOfFalse:
            if posCheck == mastermindSettings['code'][pinNo]:
                halfCorrectPins += 1
                listOfFalse.remove(pinNo)
                break


    for fullCorrectPin in range(1, fullCorrectPins + 1):
        print "&#9673;"

    for halfCorrectPin in range(1, halfCorrectPins + 1):
        print "&#9678;"

    wrongPins = 4 - (fullCorrectPins + halfCorrectPins)

    for wrongPin in range(1, wrongPins + 1):
        print "&#10005;"

    if fullCorrectPins == 4 :
        userAnswers['gameWon'] = True
        userAnswers['gameOver'] = True


#Print the checks
for row in range(1, mastermindSettings['noOfRows'] + 1):
    if userAnswers['row' + str(row)]:
        print "Row " + "%02d" % (row) + ": "
        printCode = userAnswers['row' + str(row)]
        print "&nbsp;&nbsp;&nbsp;" + ("&nbsp;&nbsp;".join(printCode)) + "&nbsp;&nbsp;&nbsp;"
        checkAnswer(userAnswers['row' + str(row)])
        print "<br />"


#End result
if userAnswers['row' + str(mastermindSettings['noOfRows'])]:
    userAnswers['gameOver'] = True

if userAnswers['gameWon'] == True:
    print "<br />You win! The code was " + (" ".join(str(mastermindSettings['code']))) + "!"

if userAnswers['gameOver'] == True and userAnswers['gameWon'] == False:
    print "<br />You lose. The code was " + (" ".join(str(mastermindSettings['code']))) + ". Better luck next time!"

print '''
    <!-- START of Training Return Button JS-->

      <!-- jQuery -->
      <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
      <!-- jQuery UI -->
      <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
      <!-- Main Script -->
      <script src="../training_button-min.js"></script>

    <!-- END of Training Return Button JS-->

</body>

'''
