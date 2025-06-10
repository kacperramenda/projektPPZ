export interface User {
    id: number;
    name: string;
    email: string;
    isActive: boolean;
}

export class AccountManager {
    private users: User[];

    constructor(users: User[] = []) {
        this.users = [...users];
    }

    deleteAccount(userId: number): boolean {
        const userIndex = this.users.findIndex(user => user.id === userId);
        
        if (userIndex === -1) {
            return false;
        }

        this.users.splice(userIndex, 1);
        return true;
    }

    getUsers(): User[] {
        return [...this.users];
    }
}

export default AccountManager;