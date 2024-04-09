describe('template spec', () => {
  it('passes', () => {
    cy.visit('http://127.0.0.1:8000/reservation')
    cy.url().should('eq', 'http://127.0.0.1:8000/login')
  })
  it('passes', () => {
    cy.visit('http://127.0.0.1:8000/reservation/unit/2')
    cy.url().should('eq', 'http://127.0.0.1:8000/login')
  })
  it('passes', () => {
    cy.visit('http://127.0.0.1:8000/pack/buy/1')
    cy.url().should('eq', 'http://127.0.0.1:8000/login')
  })
})