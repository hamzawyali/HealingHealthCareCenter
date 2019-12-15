1) In this challenge, you will design and implement API endpoints to serve a HealthCare center
application. The Healthcare center provides medical services with different types (types listed below)
through scheduled appointments to patients. Patients could browse through thousands of medial
services provided by the center and contact any of the healthcare center’s agents to schedule an
appointment for them for the selected service. The agent could issue an invoice for the patient for
one or multiple services that have been scheduled and provided. At issuing an invoice the agent
could also set a discount which could be a percentage or a flat discount if applicable (Note: both
invoice original amount, discount and total amount should be tracked). Once an invoice has been
issued the patient should receive both an email and an SMS to inform the user that the invoice has
been issued and that it’s pending his/her payment. The patient could pay the invoice online using
any of the following payment providers “PaymentX” or “PaymentY”. Each payment provider returns
different data at payment attempts (both success and failure) that needs to be saved for each
payment transaction along with the payment provider type. (Data samples listed below). If the
invoice wasn’t paid within 2 days from being issued the patient should receive a reminder through
his email to pay the invoice.
Note: The application operates across different countries and timezones.
Medical Services Types:
• Dental care
• Laboratory and diagnostic care
• Substance abuse treatment
• Preventative care
• Physical and occupational therapy
• Nutritional support
• Pharmaceutical care
• Transportation
• Prenatal care
Payment Providers sample data:
ProviderX returned sample data:
{
“customerId”: 1,
“cardType”: “Visa”,
“3D-secure-on”: true,
“success”: true
}
ProviderY returned sample data:
{
“paymentReference”: “xyz-abc”
}
Page 2 of 2
Acceptance Criteria:
• Design database schema and model
• Design and implement API endpoints to manage the following resources covering the below:
- Patients or agents could list all medical types
- Patients or agents could list and/or filter medical services by name and/or description
and/or type
-Agents could create and update medical service
-Agent could create an invoice for one or more medical services provided to the patient.
- Patient could list his/her invoices only
-Agent could list all invoices or invoices for a certain patient
-Only Patients could pay an invoice
• Implement Authentication and Authorization
• Send an email and SMS to patient to inform him/her that an invoice has been created and
informing him/her the invoice total amount. (You could use mocks if needed)
• Send email reminders to patients if an invoice had been pending for 2 days
• Log every HTTP request to the API (log to files)
Expectations
Task will be evaluated based on
1. Code quality
2. Performance considerations
3. Code scalability we should be able to add a new payment provider like “ProviderZ” with a new
schema for the returned data with the minimum possible changes
4. Unit tests
Deliverables
1. A working project covering the above requirements using php/Laravel.
2. Instructions on how to run your project along with the dependencies and environment required to
run the project
3. API Documentation
Note: Please share any assumptions you’ve had at implementing this project
2) Write a DB SQL query to find the Id of the patient who has the largest number of invoices. If there
is more than one patient with the same number of invoices, then print the one with the smallest Id.
Good Luck 
