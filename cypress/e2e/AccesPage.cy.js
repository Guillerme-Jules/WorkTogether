describe('Acces page', () => {
  beforeEach(() => {
    cy.login('user1@example.com', 'password')
  })
  it('Home', () => {
    cy.visit('http://127.0.0.1:8000')
  })
  it('Mon compte', () => {
    cy.visit('http://127.0.0.1:8000/reservation')
  })
})