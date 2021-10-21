$(async function () {
    const query = '#quotes .letters';
    let edits_to = 'edits Wikipedia to';
    let run = true;
    let quoteList = await getQuoteList();

    updateQuote();
    animate();

    /**
     * Cycle through each quote and animate
     * 
     * @returns Void
     */
    function animate() {
        let timeline = anime.timeline({
            loop: false,
            complete: function(anim) {
                // Why not just loop this? Because it doesn't work :(
                updateQuote();
                if (run) {
                    animate();
                } else {
                    finish();
                }
            }
        });
    
        timeline.add({
                targets: '#quotes .line',
                scaleY: [0, 1],
                opacity: [0.5, 1],
                easing: "easeOutExpo",
                duration: 700
            })
            .add({
                targets: ['#quotes', '#user'],
                opacity: 1,
                easing: "easeOutExpo"
            })
            .add({
                targets: '#editsto',
                opacity: 1,
                easing: "easeOutExpo"
            }, '-=775')
            .add({
                targets: '#quotes .line',
                translateX: [
                    0,
                    document.querySelector(query).getBoundingClientRect().width + 10
                ],
                easing: "easeOutExpo",
                duration: 500,
                delay: 100
            }).add({
                targets: '#quotes .letter',
                opacity: [0, 1],
                easing: "easeOutExpo",
                duration: 1000,
                delay: (el, i) => 34 * (i + 1)
            }, '-=775').add({
                // Fade out
                targets: ['#quotes', '#user', '#editsto'],
                opacity: 0,
                duration: 3000,
                easing: "easeOutExpo",
                delay: 5000
            });
    }

    /**
     * Complete the animation cycle
     * 
     * @returns Void
     */
    function finish() {
        let timeline = anime.timeline({
            loop: false
        });
    
        timeline.add({
                targets: '#quotes .line',
                scaleY: [0, 1],
                opacity: [0.5, 1],
                easing: "easeOutExpo",
                duration: 700
            })
            .add({
                targets: ['#quotes', '#user'],
                opacity: 1,
                easing: "easeOutExpo"
            })
            .add({
                targets: '#editsto',
                opacity: 1,
                easing: "easeOutExpo"
            }, '-=1000')
            .add({
                targets: '#quotes .line',
                translateX: [
                    0,
                    document.querySelector(query).getBoundingClientRect().width + 10
                ],
                easing: "easeOutExpo",
                duration: 500,
                delay: 100
            }).add({
                targets: '#quotes .letter',
                opacity: [0, 1],
                easing: "easeOutExpo",
                duration: 1000,
                delay: (el, i) => 34 * (i + 1)
            }, '-=775');
    }

    /**
     * Split the message by letters, wrapped in a span
     * Yeah I don't like it either.
     * 
     * @returns Void
     */
    function wrapLetters(query) {        
        let textWrapper = document.querySelector(query);
        textWrapper.innerHTML = textWrapper.textContent.replace(
            /(\S)/g,
            "<span class='letter'>$&</span>"
        );
    }

    /**
     * Get a random quote from the quote list, then remove it
     * 
     * @returns Object
     */
    function getQuote() {
        let keyCount = Object.keys(quoteList).length;

        if (keyCount > 0) {
            let keys = Object.keys(quoteList);
            let user = keys[Math.floor(Math.random() * keys.length)];
            let quote = quoteList[user];
            delete quoteList[user];
            return {
                user: "<a href='https://en.wikipedia.org/wiki/User:" + user + "' target='_blank'>User:" + user + "</a>",
                editsto: edits_to,
                quote: quote
            };
        } else {
            run = false;
            let edits_to = document.getElementById('editsto');
            edits_to.style.opacity = "0"; 
            return {
                user: "Lots of people",
                editsto: "edit Wikipedia for lots of reasons.",
                quote: "Have you found yours?"
            };
        }
        
    }

    /**
     * Updates the HTML user/quote text
     * 
     * @returns Void
     */
    function updateQuote() {
        let quote = getQuote();
        let user = document.getElementById('user');
        let quoteText = document.getElementById('quoteText');
        let edits_to = document.getElementById('editsto');

        user.innerHTML = quote['user'];
        edits_to.innerHTML = quote['editsto'];
        quoteText.innerHTML = quote['quote'];
        wrapLetters(query);
    }

    /**
     * Get the list of quotes from the internal API
     * 
     * @returns Object
     */
    async function getQuoteList() {
        const data = await $.getJSON('/api/?action=getAllQuotes&lang=en');
        return data.quotes;
    }
});