describe('template spec', () => {
  it('passes', () => {
    cy.visit('/reservation')
    cy.location().should((loc) => {
      expect(loc.pathname).to.eq('/login')
    })
  })
  it('passes', () => {
    cy.visit('/reservation/unit/2')
    cy.location().should((loc) => {
      expect(loc.pathname).to.eq('/login')
    })
  })
  it('passes', () => {
    cy.visit('/pack/buy/1')
    cy.location().should((loc) => {
      expect(loc.pathname).to.eq('/login')
    })
  })
})