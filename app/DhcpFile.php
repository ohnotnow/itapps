<?php

namespace App;

class DhcpFile
{
    protected $globalOptions;
    protected $sharedNetworks;
    protected $subnets;
    protected $entries;

    public function __construct($globalOptions, $sharedNetworks, $subnets, $entries)
    {
        $this->globalOptions = $globalOptions;
        $this->sharedNetworks = $sharedNetworks;
        $this->subnets = $subnets;
        $this->entries = $entries;
    }

    public function assemble()
    {
        $lines = [];
        $lines[] = $this->addComment('Global Options');
        $lines[] = $this->parseOptions($this->globalOptions);
        $lines[] = $this->addComment('Networks and Subnets');
        $lines[] = $this->parseNetworks($this->sharedNetworks);
        $lines[] = $this->parseSubnets($this->subnets);
        $lines[] = $this->addComment('Host entries');
        $lines[] = $this->parseEntries($this->entries);
        $lines[] = $this->addComment("End\n");
        return $lines;
    }

    public function asText()
    {
        return implode("\n", $this->assemble());
    }

    private function addComment($text)
    {
        return "###### {$text}\n";
    }

    private function parseOptions($options, $indent = '')
    {
        $lines = '';
        foreach ($options as $option) {
            $lines .= $indent . $option->inIscFormat();
        }
        return $lines;
    }

    private function parseEntries($entries)
    {
        $lines = '';
        foreach ($entries as $entry) {
            $lines .= $entry->inIscFormat();
        }
        return $lines;
    }

    private function parseRanges($ranges, $indent = '')
    {
        $lines = '';
        foreach ($ranges as $range) {
            $lines .= $indent . $range->inIscFormat();
        }
        return $lines;
    }

    private function parseNetworks($networks)
    {
        $lines = '';
        foreach ($networks as $network) {
            $lines .= "shared network {$network->name} {\n";
            $lines .= $this->parseSubnets($network->subnets, "\t");
            $lines .= "}\n";
        }
        return $lines;
    }

    private function parseSubnets($subnets, $indent = '')
    {
        $lines = '';
        foreach ($subnets as $subnet) {
            $lines .= $this->parseSubnet($subnet, $indent);
        }
        return $lines;
    }

    private function parseSubnet($subnet, $indent = '')
    {
        $lines = '';
        $lines .= "{$indent}subnet {$subnet->network} netmask {$subnet->netmask} {\n";
        $lines .= $this->parseOptions($subnet->options, "\t{$indent}");
        $lines .= $this->parseRanges($subnet->ranges, "\t{$indent}");
        $lines .= "{$indent}}\n";
        return $lines;
    }
}
