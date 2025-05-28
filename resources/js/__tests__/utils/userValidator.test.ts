import { describe, it, expect } from 'vitest';
import { validateEmail } from '../../utils/userValidator';

describe('Email Validator', () => {
    it('powinien zaakceptować poprawny email', () => {
        expect(validateEmail('test@example.com')).toBe(true);
        expect(validateEmail('user.name@domain.pl')).toBe(true);
    });

    it('powinien odrzucić niepoprawny email', () => {
        expect(validateEmail('niepoprawny-email')).toBe(false);
        expect(validateEmail('@domain.com')).toBe(false);
        expect(validateEmail('test@')).toBe(false);
        expect(validateEmail('test@d')).toBe(false);
    });
});