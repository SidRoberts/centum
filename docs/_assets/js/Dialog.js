const openDialog = function (event)
{
    event.preventDefault();

    const dialog = document.querySelector(this.dataset.openDialog);

    dialog.showModal();

    dialog.setAttribute('tabindex', '-1');

    // Dismiss dialog if we click outside it.
    dialog.addEventListener(
        'click',
        function(event) {
            const rect = dialog.getBoundingClientRect();

            const isInDialog = (
                rect.top <= event.clientY &&
                event.clientY <= rect.top + rect.height &&
                rect.left <= event.clientX &&
                event.clientX <= rect.left + rect.width
            );

            if (!isInDialog) {
                dialog.close();
            }
        }
    );
};



document.querySelectorAll('[data-open-dialog]').forEach(
    function (element) {
        element.addEventListener('click', openDialog);
    }
);



// Options for the observer (which mutations to observe)
const config = { attributes: true, childList: true, subtree: true };

// Callback function to execute when mutations are observed
const callback = (mutationList, observer) => {
    for (const mutation of mutationList) {
        if (mutation.type === "childList") {
            mutation.addedNodes.forEach(
                function (element) {
                    if (element.nodeType !== Node.ELEMENT_NODE) {
                        return;
                    }

                    if (element.hasAttribute('data-open-dialog')) {
                        element.addEventListener('click', openDialog);
                    } else {
                        element.querySelectorAll('[data-open-dialog]').forEach(
                            function (element) {
                                element.addEventListener('click', openDialog);
                            }
                        );
                    }
                }
            );
        }
    }
};

// Create an observer instance linked to the callback function
const observer = new MutationObserver(callback);

// Start observing the target node for configured mutations
observer.observe(document, config);
