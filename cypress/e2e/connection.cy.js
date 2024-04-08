describe('Formulaire de connection', () => {
  it('Connection reussi', () => {
    cy.visit('http://127.0.0.1:8000/login')
    cy.get('#username').type("user1@example.com")
    cy.get('#password').type("password")
    cy.get('#login').click()
    cy.url().should('eq', 'http://127.0.0.1:8000/')
  })

  it('Connection echouer', () => {
    cy.visit('http://127.0.0.1:8000/login')
    cy.get('#username').type("user1@a.com")
    cy.get('#password').type("passwordas")
    cy.get('#login').click()
    cy.get('#error').contains('Invalid credentials.')
  })
})