package com.xakcop.xxe;

import javax.xml.bind.annotation.XmlRootElement;

@XmlRootElement
public class Msg {

    int id;
    String name;
    String content;

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getContent() {
        return content;
    }

    public void setContent(String content) {
        this.content = content;
    }
}
