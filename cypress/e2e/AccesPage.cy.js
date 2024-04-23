describe('Acces page', () => {
  beforeEach(() => {
    cy.login('user1@example.com', 'password')
  })
  it('Home', () => {
    cy.visit('/')
  })
  it('Mon compte', () => {
    cy.visit('/reservation')
  })
})