import React from 'react';

const useClickOutside = (
    ref: React.RefObject<HTMLUListElement>,
    handler: () => void,
) => {
    React.useEffect(() => {
        const listener = (event: React.ChangeEvent<HTMLButtonElement>) => {
            if (!ref.current || ref.current.contains(event.target)) {
                return;
            }

            handler(event);
        };
        document.addEventListener('mousedown', listener);
        document.onkeydown = (event) => {
            if (event.key === 'Escape') {
                handler(event);
            }
        };

        return () => {
            document.removeEventListener('mousedown', listener);
        };
    }, [ref, handler]);
};

export default useClickOutside;
