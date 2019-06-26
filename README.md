# flatfair_challenge

This is a solution to flatfairs coding challenge.

## Task:

### Implement a function:
- def calculate_membership_fee(rent_amount, rent_period, organisation_unit)​ ->
int
- Define the model to represent the organisation structure. Resulting model should include
the OrganisationUnit type.

## The requirements for fee calculation were:

### Input
 - rent_amount: Integer - amount between 1-int.max
 - rent_perion: String - [‘month’, ‘week’]
 - organisation_unit: OrganisationUnit - branch instance of organisation unit

### Validation
- rent input​-​​f​unction should throw or return an error when the rent amount is outside of the range:
    - Minimum rent amount is £25 per week or £110 per month
    - Maximum rent amount is £2000 per week or £8660 per month

### Assumptions
- VAT is 20%
- Monetary amounts are stored in pence [int]

### Membership fee calculation rules (in order, from least to most important):​
- Membership fee is equal to one week of rent + VAT
- Minimum membership fee is £120 + VAT - if the rent is lower than £120 the
membership fee stays at £120
- If the organisation unit has a config object and f​ixed_membership_fee​ is t​rue override previous rules and the membership fee should be equal to the fixed_membership_fee_amount.​ Ifthepassedorganisationunitdoesn’thavea config recursively check parents until you find configuration object (ie branch doesn’t have a config check area, area doesn’t have a config check division)

### Output
- Membership fee: Integer

## Solution Details:

Because of tree like structure of 'Organisations', I decided that the "Chain of Responsibility" pattern would suit well.

- I firstly created an OrganisationUnit class and an OrganisationUnitConfig class and tested both with unit tests.
- I then created a FeeCalculator class that used the OrganisationUnit and OrganisationUnitConfig classes to calculate the fee correctly, this was also fully unit tested.
- I then created a feature test to make sure that the logic worked with the full organisation structure that was supplied for the test.
- I then created an interface for both the OrganisationUnit and OrganisationUnitConfig and type hinted those where previously I had type hinted the latter within classes.
- Finally I made the OrganisationUnit an abstract class and created a class for Area, Branch, Division and Client. This now adds additional extendability to the solution, so that in future any of those classes can override the OrganisationUnits public functions such as 'getConfig' and use custom behavior.

## To Run Tests

- Make sure you have Composer installed on your local environment https://getcomposer.org/.
- Pull this repository to your local environment into a directory of your choosing.
- Within the repositories directory on the command line, run:
    - 'composer update', this should install all required dependencies.
    - './vendor/bin/phpunit' this should run all the tests.
