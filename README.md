# flatfair_challenge

This is a solution to flatfairs coding challenge.

##Task:

###Implement a function:
- def calculate_membership_fee(rent_amount, rent_period, organisation_unit)​ ->
int
- Define the model to represent the organisation structure. Resulting model should include
the OrganisationUnit type.

##The requirements for fee calculation were:

###Input
 - rent_amount: Integer - amount between 1-int.max
 - rent_perion: String - [‘month’, ‘week’]
 - organisation_unit: OrganisationUnit - branch instance of organisation unit

###Validation
- rent input​-​​f​unction should throw or return an error when the rent amount is outside of the range:
    - Minimum rent amount is £25 per week or £110 per month
    - Maximum rent amount is £2000 per week or £8660 per month

###Assumptions
- VAT is 20%
- Monetary amounts are stored in pence [int]

###Membership fee calculation rules (in order, from least to most important):​
- Membership fee is equal to one week of rent + VAT
- Minimum membership fee is £120 + VAT - if the rent is lower than £120 the
membership fee stays at £120
- If the organisation unit has a config object and f​ixed_membership_fee​ is t​rue override previous rules and the membership fee should be equal to the fixed_membership_fee_amount.​ Ifthepassedorganisationunitdoesn’thavea config recursively check parents until you find configuration object (ie branch doesn’t have a config check area, area doesn’t have a config check division)

###Output
- Membership fee: Integer