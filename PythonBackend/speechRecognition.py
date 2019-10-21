
'''
Speech recognition object
Deals with leveraging the commands allowed to be used with speech recognition
@Author Cody Vollrath
@Version 1.0
'''
import speech_recognition as speech
import pyaudio
class SpeechRecognition:

    """
    Initlizes the audio recognizer and allows for the input of an audio file
    Uses the Houndify API to plug in to the wav file

    PreCondition audio != null
    postcondiiton none

    """
    def __init__(self):
        self.CLIENT_ID_HOUNDIFY = "lrMJd04qNu4Tzuph_FSKZA=="
        self.CLIENT_KEY_HOUNDIFY = "PwMu-ETv78Y4VM3Jo2IsbTJRlDJU_krlOoBqEfeCSzOH8bGOk84-u3_j44kPD4Q2DR9AD9YpZiB4OSXKZONeTQ=="
        self.voiceParser = speech.Recognizer()
        
    def recordAudio(self):
        with speech.Microphone() as source:
            self.voiceParser.adjust_for_ambient_noise(source,2)
            audio = self.voiceParser.listen(source, 5)
        try:
            self.displayTranscribedText(audio)
        except:
            print("Could not understand your voice :(")
    
    def displayTranscribedText(self,audio):
        self.audioIntake = self.voiceParser.recognize_houndify(audio,self.CLIENT_ID_HOUNDIFY,self.CLIENT_KEY_HOUNDIFY)
        print(self.audioIntake)

def test():
    testRecog = SpeechRecognition()
    testRecog.recordAudio()

test()
    