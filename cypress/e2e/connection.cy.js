describe('Formulaire de connection', () => {
  it('Connection reussi', () => {
    cy.visit('/login')
    cy.get('#username').type("user1@example.com")
    cy.get('#password').type("password")
    cy.get('#login').click()
    cy.location().should((loc) => {
      expect(loc.pathname).to.eq('/')
    })
  })

  it('Connection echouer', () => {
    cy.visit('/login')
    cy.get('#username').type("user1@a.com")
    cy.get('#password').type("passwordas")
    cy.get('#login').click()
    cy.get('#error').contains('Invalid credentials.')
  })
})