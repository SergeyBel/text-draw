<?php

namespace TextDraw\Figure\Diagram\Elements\Arrow;


class ArrowStyle {
    private ?string $char = null;
    
    public function getChar(): ?string {
      
        return $this->char;
    }

    public function setChar(?string $char): self{
        $this->char = $char;
        return $this;
    }


}
