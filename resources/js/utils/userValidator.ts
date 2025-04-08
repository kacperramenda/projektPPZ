export function validateEmail(email: string): boolean {
    // Podstawowa walidacja email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        return false;
    }

    // Dodatkowe sprawdzenie czy domena ma co najmniej 2 znaki
    const [, domain] = email.split('@');
    if (domain.length < 2) {
        return false;
    }

    return true;
}