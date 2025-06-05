# useToastStore Composable

The `useToastStore` composable is responsible for managing the state of toast notifications in the application. It provides methods and reactive state to add, remove, and manage toasts.

## State

- **`toasts`**: *(Array)* - A reactive array containing the list of toast objects. Each toast object has the following properties:
  - **`id`**: *(Number)* - A unique identifier for the toast.
  - **`message`**: *(String)* - The message to display in the toast.
  - **`type`**: *(String)* - The type of the toast (e.g., `'error'`, `'neutral'`, `'info'`, `'success'`).
  - **`duration`**: *(Number)* - The duration (in milliseconds) for which the toast is displayed.

## Methods

- **`addToast(toast)`**: Adds a new toast to the list.
  - **Parameters**:
    - `toast` *(Object)*: The toast object to add. Must include `id`, `message`, `type`, and `duration`.
- **`removeToast(id)`**: Removes a toast from the list by its unique identifier.
  - **Parameters**:
    - `id` *(Number)*: The unique identifier of the toast to remove.

## Example Usage

```javascript
import { useToastStore } from '@/stores/useToastStore';

const { toasts, addToast, removeToast } = useToastStore();

// Add a new toast
addToast({
  id: 1,
  message: 'Operation successful!',
  type: 'success',
  duration: 3000,
});

// Remove a toast
removeToast(1);