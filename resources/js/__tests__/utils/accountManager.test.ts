import { describe, it, expect } from 'vitest';
import { AccountManager, type User } from '../../utils/accountManager';

describe('Account Manager - Usuwanie kont', () => {
    const testUsers: User[] = [
    { id: 1, firstName: 'Jan', lastName: 'Kowalski', email: 'jan@test.pl', isActive: true },
    { id: 2, firstName: 'Anna', lastName: 'Nowak', email: 'anna@test.pl', isActive: true },
    { id: 3, firstName: 'Piotr', lastName: 'Test', email: 'piotr@test.pl', isActive: true }
];

    it('powinien usunąć istniejące konto', () => {
        const manager = new AccountManager(testUsers);
        const result = manager.deleteAccount(2);
        
        expect(result).toBe(true);
        expect(manager.getUsers()).toHaveLength(2);
        expect(manager.getUsers().find(u => u.id === 2)).toBeUndefined();
    });

    it('powinien zwrócić false przy próbie usunięcia nieistniejącego konta', () => {
        const manager = new AccountManager(testUsers);
        const result = manager.deleteAccount(999);
        
        expect(result).toBe(false);
        expect(manager.getUsers()).toHaveLength(3);
    });
});