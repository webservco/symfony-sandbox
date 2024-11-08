import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    async close() {
        this.element.style.height = 0;

        await this.#waitForAnimation();

        // this.element = element with data-controller="test"
        this.element.remove();
    }

    // Private method
    #waitForAnimation() {
        return Promise.all(
            this.element.getAnimations().map((animation) => animation.finished),
        );
    }
}