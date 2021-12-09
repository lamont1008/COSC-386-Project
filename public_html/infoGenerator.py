import csv 
import random
import string
import sys

# Contains random information generators that output in a csv file type 
# which can be loaded into a MYSQL database. 

# Clubs - don't have to randomly generate, we can include a few test
# clubs which will serve as the basis for everything else. 

# returns a list of tuples, each tuple containing a club name, website, and a generic
# place holder description; num -> number of clubs, clubNames -> list of club names

def generateClub(num, clubNames) ->list: 

    clubList = []

    for x in range(0, num): 
        clubName = clubNames[x]
        clubWebsite = clubNames[x].replace(" ", "") + '.salisbury.edu'
        description = 'This is a wonderful club that everyone should join :)'
        clubList.append((clubName, clubWebsite, description))

    return clubList


# Meetings - location (randomly choose a building name, room number), date - 
# not really sure here. May need to fix this since including a hardcoded date 
# might be confusing. time - time and date of meeting(s)... clubName (obviously
# the one already in use... may need to make sure we're picking from the same array)

# returns a list of tuples with location as a string, string of time and date, clubname) 

def generateMeetings(num, clubNames) -> list: 
    
    days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']
    times = ['6-7pm', '5-6pm', '5:30-6:30pm', '6:30-7:30pm', '7-8pm', '7:30-8:30pm', '8-9pm']
    locationBuildings = ['Academic Commons', 'Henson', 'Devilbiss', 'Perdue', 'Conway']


    meetingList = []

    for x in range(0, num):

        clubName = clubNames[x]
        index_days = random.randrange(0, len(days))
        index_times = random.randrange(0, len(times))
        index_locations = random.randrange(0, len(locationBuildings))
        meetingTime = days[index_days] + "'s " + times[index_times]
        location = locationBuildings[index_locations] + ' ' + str(random.randrange(100, 300))
        meetingList.append((clubName, meetingTime, location))

    return meetingList

# Members - name (randomly generated from a list), semesterJoined (randomly chosen
# between F2018 and F2021), major (randomly chosen from a list), position (chosen 
# from President, VP, Treasurer, and general student maybe), email (randomly generated
# from the name we chose), clubName (chosen from the same array as before)

def generateMembers(num, clubName, firstName, lastName) ->list: 

    memberList = []

    positionList = ['President', 'Vice President', 'Treasurer', 'Secretary', 'General Member']
    semesterList = ['Fall', 'Spring']
    yearList = ['2018', '2019', '2020', '2021']
    majorList = ['Accounting', 'Actuarial Science', 'American Studies', 'Biology', 'Computer Science', 'Business Administration', 
    'Chemistry', 'Communication', 'Data Science', 'Early Childhood Education', 'Earth Science', 'Economics', 'Mechanical Engineering', 
    'Government','Geography', 'History', 'Information Systems', 'Literature', 'Mathematics', 'Nursing', 'Physics', 'Political Science',
    'Sociology', 'Spanish']

    numMembers = 8

    for x in range(0, num):  # iterate through each list
        position_index = 0
        for y in range(0, numMembers):  # create members for each club name

            semester_index = random.randrange(0,len(semesterList))
            year_index = random.randrange(0, len(yearList))
            fName_index = random.randrange(0, len(firstName))
            lName_index = random.randrange(0, len(lastName))
            major_index = random.randrange(0, len(majorList))

            studentClub = clubName[x]
            studentPosition = positionList[position_index]
            yearJoined = semesterList[semester_index] + " " + yearList[year_index]
            studentName = firstName[fName_index] + " " + lastName[lName_index]
            studentEmail = studentName.replace(" ", "") + str(random.randrange(0, 1000)) + "@gulls.salisbury.edu"
            studentMajor = majorList[major_index]

            if position_index < 3: 
                position_index += 1
            else:
                position_index = 4
            
            memberList.append((studentName, yearJoined, studentMajor, studentPosition, studentEmail, studentClub))

    return memberList

# Faculty_Advisor - name (randomly chosen... not sure if we can use real profs or
# not), email (randomly chosen from name), deptAffliation (use same array as majors?),
# clubName (use same array)

def generateFacultyAdvisor(num, clubNames, firstName, lastName) ->list: 

    facultyList = []

    deptList = ['Accounting', 'Actuarial Science', 'American Studies', 'Biology', 'Computer Science', 'Business Administration', 
    'Chemistry', 'Communication', 'Data Science', 'Early Childhood Education', 'Earth Science', 'Economics', 'Mechanical Engineering', 
    'Government','Geography', 'History', 'Information Systems', 'Literature', 'Mathematics', 'Nursing', 'Physics', 'Political Science',
    'Sociology', 'Spanish']

    for x in range(0, num): 

        fName_index = random.randrange(0, len(firstName))
        lName_index = random.randrange(0, len(lastName))
        dept_index = random.randrange(0, len(deptList))

        facultyName = firstName[fName_index] + " " + lastName[lName_index]
        facultyEmail = facultyName.replace(" ", "") + str(random.randrange(0, 1000)) + "@salisbury.edu"
        facultyDeptAffiliation = deptList[dept_index]
        facultyClub = clubNames[x]

        facultyList.append((facultyName, facultyEmail, facultyDeptAffiliation, facultyClub))

    return facultyList

# Users - email (randomly generated from a random string generator; alternatively 
# can just be made like FirstNameLastName@example.com or something), password (same deal)

def generateUsers(firstName, lastName) ->list:

    num = random.randrange(10, 30)
    users = []

    for x in range(0, num):

        # username creation

        fName_index = random.randrange(0, len(firstName))
        lName_index = random.randrange(0, len(lastName))

        username = (firstName[fName_index] + " " + lastName[lName_index]).replace(" ", "") + str(random.randrange(0,1000)) + "@gulls.salisbury.edu"

        # password creation 

        length = random.randrange(10,20)

        lower = string.ascii_lowercase
        upper = string.ascii_uppercase
        num = string.digits

        all = lower + upper + num

        temp = random.sample(all, length)
        password = "".join(temp)
    
        users.append((username, password))

    return users

# Tags - name (predefined list), value (randomly assigned value between 0 and 1), clubName 
# (same list), username (same list as users - their emails)

def generateTagsForClubs(num, clubNames) ->list:

    clubTags = []

    tags = ['Sports', 'Technology', 'Outside', 'Space', 'Creative', 'General-Ed', 'Language', 'Mutli-Cultural']

    for x in range(0, num):

        values = []

        for y in range(0, len(tags)):

            clubName = clubNames[x]
            values.append((tags[y], round(random.random(),1)))

        clubTags.append((values, clubName))

    return clubTags

def generateTagsForUsers(num, usernames) ->list:

    tags = ['Sports', 'Technology', 'Outside', 'Space', 'Creative', 'General-Ed', 'Language', 'Mutli-Cultural']

    userTags = []

    for x in range(0, num):

        values = []

        for y in range(0, len(tags)):

            username = usernames[x]
            values.append((tags[y], round(random.random(),1)))

        userTags.append((values, username))

    return userTags

if __name__ == '__main__': 

    clubNames = ['Aikido Club', 'Alpha Phi Omega', 'American Sign Language Club', 'BioEnviron',
    'Educators for Social Justice', 'Esports Association', 'Middle Eastern Cultural Society', 
    'PE Society', 'Photo Club', 'Salisbury Smasherz', 'Sigma Alpha Epsilon', 
    'Starnet Society', 'Zeta Tau Alpha']

    memberFirstNames = ['James', 'John', 'Robert', 'Michael', 'William', 'David', 'Richard', 'Joseph', 'Thomas', 'Christopher', 'Daniel',
    'Mathew', 'Anthony', 'Mark', 'Steven', 'Paul', 'Andrew', 'Joshua', 'Kenneth', 'Kevin', 'Brian', 'Edward', 'Jason', 'Justin', 'Frank',
    'Alexander', 'Mary', 'Jennifer', 'Sarah', 'Jessica', 'Susan', 'Nancy', 'Ashley', 'Emily', 'Kimberly', 'Stephanie',
    'Rebecca', 'Sharon', 'Kathleen', 'Amy', 'Anna', 'Brenda', 'Rachel', 'Catherine', 'Heather', 'Virgina', 'Julie', 'Olivia', 'Joan']

    memberLastNames = ['Smith', 'Johnson', 'Williams', 'Brown', 'Jones', 'Garcia', 'Miller', 'Davis','Lopez', 'Wilson', 'Thomas', 'Jackson',
    'Lee', 'Perez', 'Harris', 'Lewis', 'King', 'Walker', 'Clark', 'Allen', 'Hill', 'Nguyen']

    professorNames = []
    usernames = []

    exampleClubList = generateClub (len(clubNames), clubNames)
    exampleMeetingList = generateMeetings(len(clubNames), clubNames)
    exampleMemberList = generateMembers(len(clubNames), clubNames, memberFirstNames, memberLastNames)
    exampleFacultyList = generateFacultyAdvisor(len(clubNames), clubNames, memberFirstNames, memberLastNames)
    exampleUserList = generateUsers(memberFirstNames, memberLastNames)

    for index, tuple in enumerate(exampleUserList):
        usernames.append(tuple[0])

    exampleClubTagsList = generateTagsForClubs(len(clubNames), clubNames)
    exampleUserTagsList = generateTagsForUsers(len(usernames), usernames)
    
    opt = sys.argv[1]
    fileName = sys.argv[2]

    with open(fileName, 'w', newline='') as csvfile: 
        writer = csv.writer(csvfile, delimiter=',')

        if opt == 'Clubs': 
            writer.writerow(['Club Name'] + ['Club Website'] + ['Description'])
            for index, tuple in enumerate(exampleClubList):
                writer.writerow([tuple[0]] + [tuple[1]]  + [tuple[2]])
        elif opt == 'Meeting': 
            writer.writerow(['Location'] + ['Meeting Time'] + ['Club Name'])
            for index, tuple in enumerate(exampleMeetingList):
                writer.writerow([tuple[2]] + [tuple[1]] + [tuple[0]])
        elif opt == 'Members': 
            writer.writerow(['Student Name'] + ['Semester Joined'] + ['Major'] + ['Position'] + ['Email'] + ['Club Name'])
            for index, tuple in enumerate(exampleMemberList): 
                writer.writerow([tuple[0]] + [tuple[1]] + [tuple[2]] + [tuple[3]] + [tuple[4]] + [tuple[5]])
        elif opt == 'Faculty': 
            writer.writerow(['Faculty Name'] + ['Faculty Email'] + ['Department Affiliation'] + ['Club Name'])
            for index, tuple in enumerate(exampleFacultyList): 
                writer.writerow([tuple[0]] + [tuple[1]] + [tuple[2]] + [tuple[3]])
        elif opt == 'Users': 
            writer.writerow(['Username'] + ['Password'])
            for index, tuple in enumerate(exampleUserList):
                writer.writerow([tuple[0]] + [tuple[1]])
        elif opt == 'ClubTags':
            writer.writerow(['Tag Name'] + ['Value'] + ['Club Name'] + ['Username'])
            for index, tuple in enumerate(exampleClubTagsList): 
                for index1, item in enumerate(tuple[0]):
                    writer.writerow( [item[0]] + [item[1]] + [tuple[1]] + ['NULL'])
        elif opt == 'UserTags':
            writer.writerow(['Tag Name'] + ['Value'] + ['Club Name'] + ['Username'])
            for index, tuple in enumerate(exampleUserTagsList):
                for index1, item in enumerate(tuple[0]):
                    writer.writerow( [item[0]] + [item[1]] + ['NULL'] + [tuple[1]])
        else: 
            print ("unrecognized option")

        