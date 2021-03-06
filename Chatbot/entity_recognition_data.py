def preprocessdata():
    TRAIN_DATA = [

        ("yes", {"entities": [(0, 3, "approved")]}),

        ("yes", {"entities": [(0, 3, "approved")]}),

        ("yes", {"entities": [(0, 3, "approved")]}),

        ("yes", {"entities": [(0, 3, "approved")]}),

        ("no", {"entities": [(0, 2, "declined")]}),

        ("no", {"entities": [(0, 2, "declined")]}),

        ("no", {"entities": [(0, 2, "declined")]}),

        ("no", {"entities": [(0, 2, "declined")]}),

        # Name doctor
        ("I would like an appointment with doctor Tim", {"entities": [(40, 43, "name_doctor")]}),

        ("I would like an appointment with doctor Ayse", {"entities": [(40, 44, "name_doctor")]}),

        ("I would like an appointment with doctor Alexander", {"entities": [(40, 49, "name_doctor")]}),

        ("I would like an appointment with doctor Michael", {"entities": [(40, 47, "name_doctor")]}),

        ("An appointment with doctor Kevin please.", {"entities": [(27, 32, "name_doctor")]}),

        ("Is doctor Carla free tomorrow?", {"entities": [(10, 15, "name_doctor")]}),

        ("Can i have an appointment with doctor Ayse?", {"entities": [(38, 42, "name_doctor")]}),

        ("Can i have an appointment with doctor Michael?", {"entities": [(38, 45, "name_doctor")]}),

        ("Can i have an appointment with doctor Peggy?", {"entities": [(38, 43, "name_doctor")]}),

        ("Can i have an appointment with doctor Liese?", {"entities": [(38, 43, "name_doctor")]}),

        ("Give me an appointment with Tim", {"entities": [(28, 31, "name_doctor")]}),

        ("Give me an appointment with Zallo", {"entities": [(28, 33, "name_doctor")]}),

        ("Give me an appointment with Tim", {"entities": [(28, 31, "name_doctor")]}),

        ("Give me an appointment with Alex", {"entities": [(28, 32, "name_doctor")]}),

        ("I need to see Tim for my leg", {"entities": [(14, 17, "name_doctor")]}),

        ("I need to see Kevin for my leg", {"entities": [(14, 19, "name_doctor")]}),

        ("I need to see Michael for my headache", {"entities": [(14, 21, "name_doctor")]}),

        ("I'll have to see Tim because it is what it is", {"entities": [(17, 20, "name_doctor")]}),

        ("I'll have to see Alex because it is what it is", {"entities": [(17, 21, "name_doctor")]}),

        ("I'll have to see Michael because it is what it is", {"entities": [(17, 24, "name_doctor")]}),

        ("Let me see Tim", {"entities": [(11, 14, "name_doctor")]}),

        ("Let me see Kevin", {"entities": [(11, 16, "name_doctor")]}),

        ("Let me see Ayse", {"entities": [(11, 15, "name_doctor")]}),

        ("Let me see Alexa", {"entities": [(11, 16, "name_doctor")]}),

        ("I want to see Tim", {"entities": [(14, 17, "name_doctor")]}),

        ("I want to see Alexa", {"entities": [(14, 19, "name_doctor")]}),

        # Appointment day
        ("I need an appointment today", {"entities": [(22, 27, "appointment_day")]}),

        ("I need an appointment tomorrow if possible", {"entities": [(22, 30, "appointment_day")]}),

        ("I need an appointment on Monday if you have a spot available", {"entities": [(25, 31, "appointment_day")]}),

        ("I need an appointment on Tuesday if you have a spot available", {"entities": [(25, 32, "appointment_day")]}),

        ("An appointment on Wednesday please", {"entities": [(18, 27, "appointment_day")]}),

        ("An appointment on Thursday please", {"entities": [(18, 26, "appointment_day")]}),

        ("An appointment on Friday please", {"entities": [(18, 24, "appointment_day")]}),

        ("I want an appointment on Monday", {"entities": [(25, 31, "appointment_day")]}),

        ("I want an appointment on Tuesday", {"entities": [(25, 32, "appointment_day")]}),

        ("I want an appointment on Wednesday", {"entities": [(25, 34, "appointment_day")]}),

        ("I want an appointment on Thursday", {"entities": [(25, 33, "appointment_day")]}),

        ("I want an appointment on Friday", {"entities": [(25, 31, "appointment_day")]}),

        ("Provide me with an appointment on Monday please", {"entities": [(34, 40, "appointment_day")]}),

        ("Provide me with an appointment on Tuesday please, i need it", {"entities": [(34, 41, "appointment_day")]}),

        ("Provide me with an appointment on Friday please", {"entities": [(34, 40, "appointment_day")]}),

        ("Provide me with an appointment on Monday please", {"entities": [(34, 40, "appointment_day")]}),

        ("I need an appointment tomorrow if possible", {"entities": [(22, 30, "appointment_day")]}),

        ("I need an appointment on Monday if you have a spot available", {"entities": [(25, 31, "appointment_day")]}),

        ("I need an appointment on Tuesday if you have a spot available", {"entities": [(25, 32, "appointment_day")]}),

        ("An appointment on Wednesday please", {"entities": [(18, 27, "appointment_day")]}),

        ("An appointment on Thursday please", {"entities": [(18, 26, "appointment_day")]}),

        # Name doctor & Appointment day
        ("Can i have an appointment with doctor Tim tomorrow?", {"entities": [(38, 41, "name_doctor"), (42, 50, "appointment_day")]}),

        ("Can i have an appointment with doctor Tim tomorrow?", {"entities": [(38, 41, "name_doctor"), (42, 50, "appointment_day")]}),

        # Appointment hour
        ("Is an appointment at 9am possible or not?", {"entities": [(22, 24, "appointment_hour")]}),

        ("I would like an appointment at 9pm", {"entities": [(32, 34, "appointment_hour")]}),

        ("Is an appointment at 9am a possibility?", {"entities": [(22, 24, "appointment_hour")]}),

        ("I would like an appointment at 1pm", {"entities": [(31, 34, "appointment_hour")]}),

        ("I would like an appointment at 2pm", {"entities": [(31, 34, "appointment_hour")]}),

        ("I would like an appointment at 3pm", {"entities": [(31, 34, "appointment_hour")]}),

        ("I would like an appointment at 4pm", {"entities": [(31, 34, "appointment_hour")]}),

        ("I would like an appointment at 5pm", {"entities": [(31, 34, "appointment_hour")]}),

        ("I would like an appointment at 6pm", {"entities": [(31, 34, "appointment_hour")]}),

        ("I need an appointment at 1pm", {"entities": [(25, 28, "appointment_hour")]}),

        ("I would like an appointment at 9pm", {"entities": [(32, 34, "appointment_hour")]}),

        ("An appointment at 1pm is what i need.", {"entities": [(18, 21, "appointment_hour")]}),

        ("An appointment at 2pm is what i need.", {"entities": [(18, 21, "appointment_hour")]}),

        ("An appointment at 3pm is what i need.", {"entities": [(18, 21, "appointment_hour")]}),

        ("An appointment at 4pm is what i need.", {"entities": [(18, 21, "appointment_hour")]}),

        ("An appointment at 5pm is what i need.", {"entities": [(18, 21, "appointment_hour")]}),

        ("An appointment at 5pm is what i need.", {"entities": [(18, 21, "appointment_hour")]}),

        ("An appointment at 12am is what i need.", {"entities": [(18, 22, "appointment_hour")]}),

        ("An appointment at 11am  is what i need.", {"entities": [(18, 22, "appointment_hour")]}),

        ("An appointment at 3pm is what i need.", {"entities": [(18, 21, "appointment_hour")]}),

        ("An appointment at 2pm is what i need.", {"entities": [(18, 21, "appointment_hour")]}),

        # Appointment hour & Appointment Day
        ("Friday at 9am would fit for me", {"entities": [(0, 6, "appointment_day"), (10, 13, "appointment_hour")]}),

        ("Thursday at 7am would fit for me", {"entities": [(0, 8, "appointment_day"), (12, 15, "appointment_hour")]}),

        ("Friday at 9am would fit for me", {"entities": [(0, 6, "appointment_day"), (10, 13, "appointment_hour")]}),

        ("Thursday at 7am would fit for me", {"entities": [(0, 8, "appointment_day"), (12, 15, "appointment_hour")]}),

        # Appointment Reason
        ("I would like an appointment since i have pain in my throat.", {"entities": [(34, 58, "appointment_reason")]}),

        ("I would like to see a doctor regarding my headache", {"entities": [(42, 50, "appointment_reason")]}),

        ("Can i get an appointment for treatment of my leg?", {"entities": [(29, 48, "appointment_reason")]}),

        ("Can i get an appointment for taking blood?", {"entities": [(29, 42, "appointment_reason")]}),

        ("Can i get an appointment for my arm?", {"entities": [(29, 35, "appointment_reason")]}),

        ("I'm feeling sick", {"entities": [(1, 16, "appointment_reason")]}),

        ("I'm having pain in my head", {"entities": [(1, 26, "appointment_reason")]}),

        ("I need an appointment for treatment of my leg", {"entities": [(26, 45, "appointment_reason")]}),

        ("I need an appointment for taking blood", {"entities": [(26, 38, "appointment_reason")]}),

        ("I need an appointment for a corona test", {"entities": [(26, 39, "appointment_reason")]}),

        ("I have pain in my head", {"entities": [(0, 22, "appointment_reason")]}),

        ("I have pain in my belly", {"entities": [(0, 23, "appointment_reason")]}),

        ("My feet are cracking", {"entities": [(0, 20, "appointment_reason")]}),

        ("Can i have an appointment for taking blood?", {"entities": [(30, 42, "appointment_reason")]}),

        ("Can i have an appointment for taking blood?", {"entities": [(30, 42, "appointment_reason")]}),

        ("Please give me an appointment for a checkup on my legs", {"entities": [(34, 54, "appointment_reason")]}),

        ("Give me an appointment for checking my vains", {"entities": [(27, 44, "appointment_reason")]}),

        ("Can i get an appointment for taking blood?", {"entities": [(29, 42, "appointment_reason")]}),

        ("Can i get an appointment for my arm?", {"entities": [(29, 35, "appointment_reason")]}),

        ("I'm feeling sick", {"entities": [(0, 16, "appointment_reason")]}),

        ("I have pain in my leg", {"entities": [(0, 21, "appointment_reason")]}),

        ("I'm having pain in my head", {"entities": [(1, 26, "appointment_reason")]}),

        ("I need an appointment for treatment of my leg", {"entities": [(26, 45, "appointment_reason")]}),

        ("I need an appointment for taking blood", {"entities": [(26, 38, "appointment_reason")]}),

        ("Can i get an appointment for treatment of my leg?", {"entities": [(29, 48, "appointment_reason")]}),

        ("Can i get an appointment for taking blood?", {"entities": [(29, 42, "appointment_reason")]}),

        ("Can i get an appointment for taking blood?", {"entities": [(29, 42, "appointment_reason")]}),

        ("Can i get an appointment for my arm?", {"entities": [(29, 35, "appointment_reason")]}),

        ("I'm feeling sick", {"entities": [(0, 16, "appointment_reason")]}),

        # Reason and doctor
        ("i'm feeling sick so i would like an appointment with doctor tim", {"entities": [(0, 16, "appointment_reason"), (60, 63, "name_doctor")]}),

        ("My throat hurts so i would like an appointment with doctor tim", {"entities": [(0, 15, "appointment_reason"), (59, 62, "name_doctor")]}),

        ("i'm feeling sick so i would like an appointment with doctor tim", {"entities": [(0, 16, "appointment_reason"), (60, 63, "name_doctor")]}),

        ("My throat hurts so i would like an appointment with doctor tim", {"entities": [(0, 15, "appointment_reason"), (59, 62, "name_doctor")]}),

    ]
    return TRAIN_DATA