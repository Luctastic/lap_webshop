<?php

namespace App;

class Defaults
{
    public final const DEFAULT_VERSION_ID = '5042acf5-5cac-4ddf-a1f3-ffdbef69f0f8';

    // note: states should be in english - then we could load a corresponding snippet in the storefront
    // -> but we only support german currently - so we access it instead directly

    // general states
    public final const STATE_OPEN = 'offen';
    public final const STATE_IN_PROGRESS = 'in Bearbeitung';
    public final const STATE_FAILED = 'fehlgeschlagen';
    public final const STATE_DONE = 'abgeschlossen';

    public final const STATE_OPEN_ID = 1;
    public final const STATE_IN_PROGRESS_ID = 2;
    public final const STATE_FAILED_ID = 3;
    public final const STATE_DONE_ID = 4;

    // specific delivery states
    public final const STATE_IN_DELIVERY = 'in Zustellung';
    public final const STATE_IN_DELIVERY_ID = 5;
}
