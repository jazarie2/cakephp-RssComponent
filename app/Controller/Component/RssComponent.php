<?php
/**
 * Copyright (c) 2012 Jan Dorsman
 *
 * Licensed under the The MIT License (MIT) - http://www.opensource.org/licenses/MIT
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"),
 * to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
 * DEALINGS IN THE SOFTWARE. 
 */

App::uses('Xml', 'Utility');
 
class RssComponent extends Component {
 
    /**
     * Reads an (external) RSS feed and returns it's items.
     *
     * @param $feed - The URL to the feed.
     * @param int $items - The amount of items to read.
     * @return array
     * @throws InternalErrorException
     */
    public function read($feed, $items = 5) {
        try {
            // Try to read the given RSS feed
            $xmlObject = Xml::build($feed);
        } catch (XmlException $e) {
            // Reading XML failed, throw InternalErrorException
            throw new InternalErrorException();
        }
 
        $output = array();
 
        for($i = 0;$i < $items;$i++):
            if(is_object($xmlObject->channel->item->$i)) {
                $output[] = $xmlObject->channel->item->$i;
            }
        endfor;
 
        return $output;
    }
 
}
