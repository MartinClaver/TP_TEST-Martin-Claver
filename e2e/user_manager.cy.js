describe('User Management E2E Test', () => {
  beforeEach(() => {
    cy.visit('http://localhost/gestion_produit/src/')
    cy.get('h1').should('contain', 'Gestion des utilisateurs')
  })

it('Ajoute un utilisateur, le modifie, puis le supprime', () => {
  const userName = 'John Doe';
  const userEmail = 'john.doe@example.com';
  const role = 'Papa';
  const updatedUserName = 'Jane Doe';

  // Ajouter un utilisateur
  cy.get('input[placeholder="Nom"]').type(userName);
  cy.get('#email').type(userEmail);
  cy.get('#role').type(role);
  cy.get('#userForm').submit();

  // Vérifier que l'utilisateur est bien affiché
  cy.get('#userList li').should('contain', userName).and('contain', userEmail).and('contain', role);

  // Modifier l'utilisateur
  cy.get('#userList li button').contains('✏️').click();
  cy.get('#name').clear().type(updatedUserName);
  cy.get('#userForm').submit();

  // Vérifier que le nom de l'utilisateur est bien modifié
  cy.get('#userList li').should('contain', updatedUserName).and('contain', userEmail);

  // Supprimer l'utilisateur
  cy.get('#userList li button').contains('❌').click();

  // Vérifier que l'utilisateur est bien supprimé
  cy.get('#userList li').should('not.exist');
});
});
